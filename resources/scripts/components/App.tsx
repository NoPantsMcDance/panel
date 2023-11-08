import React, { lazy } from 'react';
import { hot } from 'react-hot-loader/root';
import { Route, Router, Switch } from 'react-router-dom';
import { StoreProvider } from 'easy-peasy';
import { store } from '@/state';
import { SiteSettings } from '@/state/settings';
import ProgressBar from '@/components/elements/ProgressBar';
import { NotFound } from '@/components/elements/ScreenBlock';
import tw from 'twin.macro';
import GlobalStylesheet from '@/assets/css/GlobalStylesheet';
import { history } from '@/components/history';
import { setupInterceptors } from '@/api/interceptors';
import AuthenticatedRoute from '@/components/elements/AuthenticatedRoute';
import { ServerContext } from '@/state/server';
import '@/assets/tailwind.css';
import Spinner from '@/components/elements/Spinner';
import LoginNavbar from '@/components/LoginNavbar';
import Sidebar from './Sidebar';
// import Header from './Header';
import SidebarServer from './SidebarServer';

const DashboardRouter = lazy(() => import(/* webpackChunkName: "dashboard" */ '@/routers/DashboardRouter'));
const ServerRouter = lazy(() => import(/* webpackChunkName: "server" */ '@/routers/ServerRouter'));
const AuthenticationRouter = lazy(() => import(/* webpackChunkName: "auth" */ '@/routers/AuthenticationRouter'));

interface ExtendedWindow extends Window {
    SiteConfiguration?: SiteSettings;
    PterodactylUser?: {
        uuid: string;
        username: string;
        email: string;
        /* eslint-disable camelcase */
        root_admin: boolean;
        use_totp: boolean;
        language: string;
        updated_at: string;
        created_at: string;
        /* eslint-enable camelcase */
    };
}

declare global {
    interface Window {
        settings: {
            ['brand-logo']: string;
            mainbtnurl: string;
            mainbtnname: string;
        };
        copyright: string;
        headername: string | undefined;
        userlogo: string | undefined;
    }
}

setupInterceptors(history);

const App = () => {
    const { PterodactylUser, SiteConfiguration } = window as ExtendedWindow;
    if (PterodactylUser && !store.getState().user.data) {
        store.getActions().user.setUserData({
            uuid: PterodactylUser.uuid,
            username: PterodactylUser.username,
            email: PterodactylUser.email,
            language: PterodactylUser.language,
            rootAdmin: PterodactylUser.root_admin,
            useTotp: PterodactylUser.use_totp,
            createdAt: new Date(PterodactylUser.created_at),
            updatedAt: new Date(PterodactylUser.updated_at),
        });
    }

    if (!store.getState().settings.data) {
        store.getActions().settings.setSettings(SiteConfiguration!);
    }

    return (
        <>
            <GlobalStylesheet />
            <StoreProvider store={store}>
                <ProgressBar />
                <div css={tw`mx-auto w-auto`}>
                    <Router history={history}>
                        <Switch>
                            <Route path={'/auth'}>
                                <Spinner.Suspense>
                                    <LoginNavbar />
                                    <AuthenticationRouter />
                                </Spinner.Suspense>
                            </Route>
                            <AuthenticatedRoute path={'/server/:id'}>
                                <div
                                    className='max-w-full max-h-full flex w-100 font-medium relative text-[15px]'
                                    style={{ background: 'var(--theme-bg)' }}
                                >
                                    <ServerContext.Provider>
                                        <SidebarServer />
                                        <div className='flex flex-col grow max-[1250px]:contents w-3/4'>
                                            {/* <Header /> */}
                                            <div className='px-8 pb-8 max-[1250px]:px-5 max-[1250px]:pb-5' id='content'>
                                                <Spinner.Suspense>
                                                    <ServerRouter />
                                                </Spinner.Suspense>
                                            </div>
                                        </div>
                                    </ServerContext.Provider>
                                </div>
                            </AuthenticatedRoute>
                            <AuthenticatedRoute path={'/'}>
                                <div
                                    className='max-w-full max-h-full flex w-100 font-medium relative text-[15px]'
                                    style={{ background: 'var(--theme-bg)' }}
                                >
                                    <Sidebar />
                                    <div className='w-full'>
                                        {/* <Header /> */}
                                        <div className='px-8 pb-8 max-[1250px]:px-5 max-[1250px]:pb-5'>
                                            <Spinner.Suspense>
                                                <DashboardRouter />
                                            </Spinner.Suspense>
                                        </div>
                                    </div>
                                </div>
                            </AuthenticatedRoute>
                            <Route path={'*'}>
                                <div
                                    className='max-w-full max-h-full flex w-100 font-medium relative text-[15px]'
                                    style={{ background: 'var(--theme-bg)' }}
                                >
                                    <Sidebar />
                                    <div className='w-full'>
                                        {/* <Header /> */}
                                        <div className='px-8 pb-8 max-[1250px]:px-5 max-[1250px]:pb-5'>
                                            <NotFound />
                                        </div>
                                    </div>
                                </div>
                            </Route>
                        </Switch>
                    </Router>
                </div>
            </StoreProvider>
        </>
    );
};

export default hot(App);
