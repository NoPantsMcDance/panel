import http from '@/api/http';
import { ApplicationStore } from '@/state';
import { faCogs, faLayerGroup, faPalette, faSignOutAlt } from '@fortawesome/free-solid-svg-icons';
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome';
import { useStoreState } from 'easy-peasy';
import React, { useEffect, useState } from 'react';
import { NavLink } from 'react-router-dom';
import tw from 'twin.macro';
import SpinnerOverlay from './elements/SpinnerOverlay';
import $ from 'jquery';
import { faAdjust, faChartLine, faSignal } from '@fortawesome/free-solid-svg-icons';

export default () => {
    const name = useStoreState((state: ApplicationStore) => state.settings.data!.name);
    const rootAdmin = useStoreState((state: ApplicationStore) => state.user.data!.rootAdmin);
    const [isLoggingOut, setIsLoggingOut] = useState(false);

    const onTriggerLogout = () => {
        setIsLoggingOut(true);
        http.post('/auth/logout').finally(() => {
            // @ts-expect-error this is valid
            window.location = '/';
        });
    };

    useEffect(() => {
        function handleResize() {
            if ($(window).width()! > 1090) {
                $('#sidebar').removeClass('collapse');
            } else {
                $('#sidebar').addClass('collapse');
            }
        }
        handleResize();

        $(window).on('resize', handleResize);
        return () => {
            $(window).off('resize', handleResize);
        };
    }, []);

    return (
        <>
            <SpinnerOverlay visible={isLoggingOut} />
            <div
                className='w-60 pl-4 flex flex-col shrink-0 duration-200 overflow-y-auto overflow-x-hidden sticky top-0'
                id='sidebar'
            >
                { <NavLink
                    to={'/'}
                    className='hidden w-8 h-8 shrink-0 items-center rounded-[50%] justify-center'
                    id='mobile-logo'
                    isActive={() => false}
                >
                    <img
                        className='w-[42px] p-1'
                        src={
                            window.settings['brand-logo']
                                ? window.settings['brand-logo']
                                : '/assets/svgs/pterodactyl.svg'
                        }
                    />
                </NavLink>}
                <NavLink
                    to={'/'}
                    className='flex items-center justify-center no-underline text-[var(--body-active-color)] leading-8 sticky top-0 before:content-[""] before:absolute before:top-[-30px] before:left-0 before:bg-[var(--theme-bg)] before:z-[-1]'
                    id='logo'
                    isActive={() => false}
                >
                    <img
                        style={{ width: '1049px', height: 'auto' }}
                        className=''
                        id='logo-img'
                        src={
                            window.settings['brand-logo']
                                ? window.settings['brand-logo']
                                : '/assets/svgs/pterodactyl.svg'
                        }
                    />
                    {/* {name} */}
                </NavLink>

                <div className='side-wrapper'>
                    <div className='side-title'>MENU</div>
                    <div className='side-menu'>
                        <NavLink
                            to={'/'}
                            className='sidebar-link'
                            isActive={(_match, location) => location.pathname === '/'}
                        >
                            <FontAwesomeIcon icon={faLayerGroup} css={tw`!w-8 h-8`} /> Dashboard
                        </NavLink>
                        <a 
                            className='sidebar-link' 
                            href='https://grafana.suhosting.net/public-dashboards/4749c771c6514b62a23e7f680b26afde?orgId=1&refresh=1m' 
                            target="_blank" 
                            rel="noopener noreferrer"
                        >
                            <FontAwesomeIcon icon={faChartLine} css={tw`!w-8 h-8`} /> Node Stats
                        </a>
                        <a 
                            className='sidebar-link' 
                            href='https://status.suhosting.net/status/nodestatus' 
                            target="_blank" 
                            rel="noopener noreferrer"
                        >
                            <FontAwesomeIcon icon={faSignal} css={tw`!w-8 h-8`} /> Node Status
                        </a>
                    </div>
                </div>

                <div className='side-wrapper'>
                    <div className='side-title'>USER SETTINGS</div>
                    <div className='side-menu'>
                        {rootAdmin && (
                            <>
                                <a className='sidebar-link' href='/admin'>
                                    <FontAwesomeIcon icon={faCogs} css={tw`!w-8 h-8`} /> Admin
                                </a>

                                <a className='sidebar-link' href='/admin/unix'>
                                    <FontAwesomeIcon icon={faPalette} css={tw`!w-8 h-8`} /> Configure
                                </a>
                            </>
                        )}
                        <NavLink to={'/account'} className='sidebar-link'>
                            <FontAwesomeIcon icon={faCogs} css={tw`!w-8 h-8`} /> Account
                        </NavLink>

                        <a className='sidebar-link' id='logout' onClick={onTriggerLogout}>
                            <FontAwesomeIcon icon={faSignOutAlt} css={tw`!w-8 h-8`} /> Sign Out
                        </a>
                        <a className='sidebar-link' href='/switch-mode'>
                                    <FontAwesomeIcon icon={faAdjust} css={tw`!w-8 h-8`} /> Dark/Light
                        </a>      
                    </div>
                </div>
            </div>
        </>
    );
};
