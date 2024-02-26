import React from 'react';
import { createRoot } from 'react-dom/client';
import { ApiRegion, ChannelType, ChannelRepository, ChannelFilter, ChannelSortingMethod } from "@amityco/js-sdk";
import { AmityUiKitProvider, AmityUiKitChat } from "@amityco/ui-kit-open-source";

export default function ChatAmity() {

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

    const [channelId, setChannelId] = React.useState()
    const [recentChatOpen, setRecentChatOpen] = React.useState(true)
    const [noChats, setNoChats] = React.useState(false)

    async function startChannel() {

        const userMemberName = userMember.alias ? userMember.alias : userMember.name
        const userWownessName = userWowness.alias ? userWowness.alias : userWowness.name

        const newChannel = {
          displayName: `${userMemberName} and ${userWownessName} `,
          type: ChannelType.Conversation,
          userIds: [userMember.id]
        };

        const liveChannel = ChannelRepository.createChannel(newChannel);

        liveChannel.once('dataUpdated', model => {
            console.log('Channel created')
            setChannelId(model.channelId)
        });

        liveChannel.once('dataError', error => {
           console.log(error)
        });
    }

    async function queryChannel() {
        const liveCollection = ChannelRepository.queryChannels({
            filter: ChannelFilter.Member,
            sortBy: ChannelSortingMethod.LastCreated,
            });
            liveCollection.on('dataUpdated', channels => {
                if(channels.length == 0) {
                    setNoChats(true)
                }
            });
    }

    function openRecentChat() {
        document.querySelector('.RecentContainer-iLwGpt').classList.toggle('open')
        document.querySelector('.buttonRecentChat').classList.toggle('openRecentChat')
        setRecentChatOpen(!recentChatOpen)
    }

    React.useEffect(()=>{
        document.querySelector('.RecentContainer-iLwGpt').classList.add('open')
        setTimeout(queryChannel, 3000)
        if (userMember) {
            setTimeout(()=> {
                startChannel()
            }, 800)
        }
    },[channelId])

    if (userWowness) {
        return (
            <div>
                {noChats
                ? <div style={{position:'absolute',right: '35%', top: '10px'}}>
                    <div class="alert alert-danger text-center" role="alert" >
                        You have no chats started
                    </div>
                  </div>
                : ''
                }
                <div className="buttonRecentChat openRecentChat" onClick={openRecentChat}>
                    {recentChatOpen
                    ?<i className="bi bi-x-lg"></i>
                    :<><i className="bi bi-chat-left-dots-fill"></i> Chats</>}
                </div>
                <AmityUiKitProvider
                    key={userId}
                    apiKey={apiKey}
                    userId={userId}
                    apiRegion={ApiRegion.EU}
                    theme={myTheme}>
                    <AmityUiKitChat defaultChannelId={channelId}/>
                </AmityUiKitProvider>
            </div>
        )
    }

    return (
        <div className='container py-4'>
            <h1 className='text-center'>You need to log in</h1>
        </div>
    )
  }

if (document.getElementById('ChatAmity')) {
    createRoot(document.getElementById('ChatAmity')).render(<ChatAmity />)
}
