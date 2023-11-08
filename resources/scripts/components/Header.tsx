import React, { useState } from 'react';
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome';
import {
    faAdjust,
    faSignOutAlt,
    faChevronDown,
    faCog,
    faList,
    faUser,
    faTerminal,
    faKey,
    faSearch,
} from '@fortawesome/free-solid-svg-icons';
import { useStoreState } from 'easy-peasy';
import { ApplicationStore } from '@/state';
import { NavLink } from 'react-router-dom';
import http from '@/api/http';
import SpinnerOverlay from './elements/SpinnerOverlay';
import useEventListener from '@/plugins/useEventListener';
import SearchModal from './dashboard/search/SearchModal';
import tw from 'twin.macro';
import Color from 'color';

export default () => {
    const rootAdmin = useStoreState((state: ApplicationStore) => state.user.data!.rootAdmin);
    const [isLoggingOut, setIsLoggingOut] = useState(false);
    const [visible, setVisible] = useState(false);

    useEventListener('keydown', (e: KeyboardEvent) => {
        if (['input', 'textarea'].indexOf(((e.target as HTMLElement).tagName || 'input').toLowerCase()) < 0) {
            if (!visible && e.metaKey && e.key.toLowerCase() === '/') {
                setVisible(true);
            }
        }
    });

    const onTriggerLogout = () => {
        setIsLoggingOut(true);
        http.post('/auth/logout').finally(() => {
            // @ts-expect-error this is valid
            window.location = '/';
        });
    };

    const dropdownBackground = () => {
        const color = Color(window.getComputedStyle(document.body).getPropertyValue('--dropdown-bg'));
        if (color.isDark())
            return color.hsl().lighten(0.3).hex();

        return color.hsl().lighten(0.1).hex();
    };

    return (
        <>
            {visible && <SearchModal appear visible={visible} onDismissed={() => setVisible(false)} />}
            <SpinnerOverlay visible={isLoggingOut} />
            <div className='flex items-center shrink-0 px-8 py-4 sticky top-0 z-[40] backdrop-blur-sm'>
                <div className='h-8 flex w-full max-w-md relative' id='search' onClick={() => setVisible(true)}>
                    <input
                        className='cursor-pointer w-full h-full border-none rounded-lg text-sm font-medium pr-10 pl-4 shadow-sm color-white-100'
                        style={{ background: 'var(--button-bg)' }}
                        type='text'
                        placeholder='Search'
                        disabled
                    />
                    <span className='absolute top-1/2 right-4 transform -translate-y-1/2 cursor-pointer'>
                        <FontAwesomeIcon icon={faSearch} css={tw`text-sm`} />
                    </span>
                </div>
                <div className='flex items-center pl-5 shrink-0 ml-auto'>
                    <a
                        href='/switch-mode'
                        className='w-8 h-8 mr-4 flex items-center justify-center rounded-lg text-[16px] text-white bg-[var(--button-bg)]'
                        id='switch-mode'
                        style={{ background: 'var(--button-bg)' }}
                    >
                        <FontAwesomeIcon icon={faAdjust} />
                    </a>
                    <img
                        className='w-8 h-8 shrink-0 object-cover rounded-[50%]'
                        src={`https://www.gravatar.com/avatar/${window.userlogo}?s=160`}
                    />
                    <div className='relative inline-block' id='dropdown'>
                        <div
                            className='pl-1.5 pr-3 text-[14px] max-[575px]:hidden cursor-pointer'
                            style={{ color: 'var(--body-active-color)' }}
                        >
                            <span id='header-name'>{window.headername}</span>
                            <FontAwesomeIcon icon={faChevronDown} className='ml-2' />
                        </div>
                        <div
                            className='hidden absolute min-w-[9rem] z-[1] right-0 shadow-2xl rounded-md'
                            id='dropdown-content'
                            style={{ background: dropdownBackground() }}
                        >
                            <NavLink
                                className='py-2 px-2.5 no-underline block'
                                style={{ color: 'var(--body-active-color)' }}
                                to={'/account'}
                            >
                                <FontAwesomeIcon icon={faUser} /> Account
                            </NavLink>
                            <NavLink
                                className='py-2 px-2.5 no-underline block'
                                style={{ color: 'var(--body-active-color)' }}
                                to={'/account/api'}
                            >
                                <FontAwesomeIcon icon={faKey} /> API Credentials
                            </NavLink>
                            <NavLink
                                className='py-2 px-2.5 no-underline block'
                                style={{ color: 'var(--body-active-color)' }}
                                to={'/account/ssh'}
                            >
                                <FontAwesomeIcon icon={faTerminal} /> SSH Keys
                            </NavLink>
                            <NavLink
                                className='py-2 px-2.5 no-underline block'
                                style={{ color: 'var(--body-active-color)' }}
                                to={'/account/activity'}
                            >
                                <FontAwesomeIcon icon={faList} /> Activity
                            </NavLink>
                            {rootAdmin && (
                                <a
                                    href='/admin'
                                    className='py-2 px-2.5 no-underline block'
                                    style={{ color: 'var(--body-active-color)' }}
                                >
                                    <FontAwesomeIcon icon={faCog} /> Admin
                                </a>
                            )}
                            <a
                                className='py-2 px-2.5 no-underline block cursor-pointer'
                                style={{ color: 'var(--body-active-color)' }}
                                onClick={onTriggerLogout}
                            >
                                <FontAwesomeIcon icon={faSignOutAlt} /> Sign Out
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </>
    );
};
