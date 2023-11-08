import React from 'react';
import { useStoreState } from 'easy-peasy';
import { ApplicationStore } from '@/state';

export default () => {
    const name = useStoreState((state: ApplicationStore) => state.settings.data!.name);

    return (
        <div id={window.copyright} className='menu' style={{ display: 'flex', justifyContent: 'center', paddingTop: '100px' }}>
            <div className='logo'>
                <img
                    id='login-image'
                    className=''
                    src='/assets/SUHText512xShadow.png'
                />
            </div>
        </div>
    );
};