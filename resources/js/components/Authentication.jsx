import React from 'react';
import { createRoot } from 'react-dom/client';
import AmityClient, { ApiRegion, ConnectionStatus, onConnected } from "@amityco/js-sdk";

export default function Authentication() {

    const apiKey = "b0e9ed5d6f8fa1344537884f5500478b845f85eab8366a2a"
    const userId = userWowness.id
    const description = userWowness.bio ? userWowness.bio : ''
    const displayName = userWowness.alias ? userWowness.alias : userWowness.name
    const avatarCustomUrl = window.location.origin + '/storage/' + userWowness.photo
    const roles = userWowness.role == 1 ? ['4'] : ['1']

    async function login() {

        const client = new AmityClient({
            apiKey,
            apiRegion: ApiRegion.EU,
        })

        client.registerSession({
            userId: userId,
            displayName: displayName,
        });
        client.on("connectionStatusChanged", ({ newValue }) => {
            if (newValue === ConnectionStatus.Connected) {

                const updateUser = async () => {
                    const success = await client.updateCurrentUser({
                        description,
                        avatarCustomUrl,
                        roles
                    })
                }
                updateUser()
                onConnected && onConnected(true);
            } else {
                onConnected && onConnected(false);
            }
        });
   }

   React.useEffect(() => {
    login()
   },[])

    if (userWowness) {
        return (
            <div>Logado</div>
        )
    }

    return (
        <div className='container py-4'>
            <h1 className='text-center'>You need to log in</h1>
        </div>
    )
  }

if (document.getElementById('Authentication')) {
    createRoot(document.getElementById('Authentication')).render(<Authentication />)
}
