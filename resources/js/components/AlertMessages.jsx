import React from 'react';
import { createRoot } from 'react-dom/client';
import { ChannelRepository, ChannelFilter, ChannelSortingMethod } from "@amityco/js-sdk";

export default function AlertMessages() {

    const [unreadMessages, setUnreadMessages] = React.useState(false)

    async function queryChannel() {
        const liveCollection = ChannelRepository.queryChannels({
            filter: ChannelFilter.Member,
            sortBy: ChannelSortingMethod.LastCreated,
            });
            liveCollection.on('dataUpdated', channels => {
                channels.forEach( channel => {
                    if (channel.unreadCount > 0) {
                        setUnreadMessages(true)
                    }
                })
            });
            liveCollection.on('dataError', error => {
                console.log(error);
            });
    }

    React.useEffect(()=>{
        setTimeout(queryChannel, 2000)
    },[])

    return (
        <div>
            <a href="/chat" className="btn_1 p-3 fw-bold" style={{position:'relative'}}>
                <i className="bi bi-chat-left-dots-fill"></i>
                {unreadMessages ? <span style={{position: 'absolute',
                                                right: '0',
                                                bottom: '0',
                                                backgroundColor: 'red',
                                                padding: '2px 7px',
                                                borderRadius: '100%'}}>!</span> : ''}
            </a>
        </div>
    )
  }

if (document.getElementById('AlertMessages')) {
    createRoot(document.getElementById('AlertMessages')).render(<AlertMessages />)
}
