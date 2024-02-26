import React from 'react';
import { createRoot } from 'react-dom/client';
import { ApiRegion } from "@amityco/js-sdk";
import { AmityUiKitProvider, AmityUiKitChat } from "@amityco/ui-kit-open-source";

export default function ModalChatHandler() {

    const myTheme = {
        palette: {
            primary:'#8EAF7E',
        },
        typography: {
          global: {
            fontFamily: '"Montserrat", Helvetica, sans-serif',
            fontStyle: 'normal',
          }
        },
    };

    const apiKey = "b0e9ed5d6f8fa1344537884f5500478b845f85eab8366a2a"
    const userId = userWowness.id
    const displayName = userWowness.alias ? userWowness.alias : userWowness.name

    const [channelId, setChannelId] = React.useState()
    const [modalOpen, setModalOpen] = React.useState(false)

    const closeModalChat = () => {
        sessionStorage.removeItem('channelIdInit')
        setChannelId(sessionStorage.getItem('channelIdInit'))
    }

    const minimizeModalChat = () => {
        document.querySelector('.ModalChat').classList.remove('show')
        setModalOpen(false)
    }

    const openModalChat = () => {
        document.querySelector('.ModalChat').classList.add('show')
        setModalOpen(true)
    }

    React.useEffect(()=> {
        setChannelId(sessionStorage.getItem('channelIdInit'))
    },[channelId])

    if (userWowness && channelId && !document.getElementById('ButtonInitChatPract') && !document.getElementById('ChatAmity')) {
        return (
            <div className="ModalChat">
                {modalOpen ?
                    <button className="btn" style={{position:'absolute',
                                                right:'30px',
                                                padding:'3px 7px',
                                                color: '#fff',
                                                backgroundColor: '#92c17b',
                                                borderRadius: '19px 0 0 0',
                                                top: '-32px'}} onClick={minimizeModalChat}><i className="bi bi-arrow-bar-down"></i></button>
                    :
                    <button className="btn" style={{position:'absolute',
                                                right:'30px',
                                                padding:'3px 7px',
                                                color: '#fff',
                                                backgroundColor: '#92c17b',
                                                borderRadius: '19px 0 0 0',
                                                top: '-32px'}} onClick={openModalChat}><i className="bi bi-arrow-bar-up"></i></button>
                }

                <button className="btn" style={{position:'absolute',
                                                right:'0',
                                                padding:'3px 7px',
                                                color: '#fff',
                                                backgroundColor: '#92c17b',
                                                borderRadius: '0 19px 0 0',
                                                top: '-32px'}} onClick={closeModalChat}><i className="bi bi-x-lg"></i></button>
                <AmityUiKitProvider theme={myTheme} key={userId} apiKey={apiKey} userId={userId} displayName={displayName} apiRegion={ApiRegion.EU}>
                    <AmityUiKitChat defaultChannelId={channelId}/>
                </AmityUiKitProvider>
            </div>
        )
    }

    return (
        <>
        </>
    )
  }

if (document.getElementById('ModalChatHandler')) {
    createRoot(document.getElementById('ModalChatHandler')).render(<ModalChatHandler />)
}
