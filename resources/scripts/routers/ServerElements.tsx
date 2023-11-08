import React from 'react';
import { ServerContext } from '@/state/server';
import routes from '@/routers/routes';
import Can from '@/components/elements/Can';
import { NavLink, Route, Switch, useRouteMatch } from 'react-router-dom';
import PermissionRoute from '@/components/elements/PermissionRoute';
import Spinner from '@/components/elements/Spinner';
import { NotFound } from '@/components/elements/ScreenBlock';
import TransitionRouter from '@/TransitionRouter';
import { useLocation } from 'react-router';
import tw from 'twin.macro';
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome';

interface Props {
    route: any;
    sidebar?: boolean;
    link?: boolean;
}

const NavItem = ({ route, link }: Props) => {
    const match = useRouteMatch<{ id: string }>();

    const nestId = ServerContext.useStoreState((state) => state.server.data?.nestId);
    const eggId = ServerContext.useStoreState((state) => state.server.data?.eggId);

    const to = (value: string, url = false) => {
        return `${(url ? match.url : match.path).replace(/\/*$/, '')}/${value.replace(/^\/+/, '')}`;
    };

    return (
        ((route.nestIds && route.nestIds.includes(nestId ?? 0)) ||
            (route.eggIds && route.eggIds.includes(eggId ?? 0)) ||
            (route.nestId && route.nestId === nestId) ||
            (route.eggId && route.eggId === eggId) ||
            (!route.eggIds && !route.nestIds && !route.nestId && !route.eggId)) && (
            <NavLink to={to(route.path, true)} exact={route.exact} className={link ? 'sidebar-link' : undefined}>
                {route.icon && link && <FontAwesomeIcon icon={route.icon} css={tw`!w-8 h-8`} />}
                {route.name}
            </NavLink>
        )
    );
};

export const Navigation = () => {
    return (
        <>
            {routes.server
                .filter((route) => !!route.name)
                .map((route) =>
                    route.permission ? (
                        <Can key={route.path} action={route.permission} matchAny>
                            <NavItem route={route} />
                        </Can>
                    ) : (
                        <React.Fragment key={route.path}>
                            <NavItem route={route} />
                        </React.Fragment>
                    )
                )}
        </>
    );
};

export const NavigationSidebar = () => {
    return (
        <>
            {routes.server
                .filter((route) => !!route.name)
                .map((route) =>
                    route.permission ? (
                        <Can key={route.path} action={route.permission} matchAny>
                            <NavItem route={route} link={true} />
                        </Can>
                    ) : (
                        <React.Fragment key={route.path}>
                            <NavItem route={route} link={true} />
                        </React.Fragment>
                    )
                )}
        </>
    );
};

export const ComponentLoader = () => {
    const match = useRouteMatch<{ id: string }>();
    const location = useLocation();

    const serverNestId = ServerContext.useStoreState((state) => state.server.data?.nestId);
    const serverEggId = ServerContext.useStoreState((state) => state.server.data?.eggId);

    const to = (value: string, url = false) => {
        return `${(url ? match.url : match.path).replace(/\/*$/, '')}/${value.replace(/^\/+/, '')}`;
    };

    return (
        <>
            <TransitionRouter>
                <Switch location={location}>
                    {routes.server.map(({ path, permission, component: Component, nestIds, eggIds, nestId, eggId }) => {
                        return (
                            ((nestIds && nestIds.includes(serverNestId ?? 0)) ||
                                (eggIds && eggIds.includes(serverEggId ?? 0)) ||
                                (nestId && serverNestId === nestId) ||
                                (eggId && serverEggId === eggId) ||
                                (!eggIds && !nestIds && !nestId && !eggId)) && (
                                <PermissionRoute key={path} permission={permission} path={to(path)} exact>
                                    <Spinner.Suspense>
                                        <Component />
                                    </Spinner.Suspense>
                                </PermissionRoute>
                            )
                        );
                    })}
                    <Route path={'*'} component={NotFound} />
                </Switch>
            </TransitionRouter>
        </>
    );
};
