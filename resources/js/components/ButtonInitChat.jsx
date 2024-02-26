import React from 'react';
import { createRoot } from 'react-dom/client';
import {ChannelRepository, ChannelType, UserRepository } from "@amityco/js-sdk";
import ModalChat from './ModalChat';

export default function ButtonInitChat() {

    const idUser = userWowness.id
    const idPractitioner = userPractitioner.id
    const nameUser = userWowness.alias ? userWowness.alias :  userWowness.name
    const namePract = userPractitioner.alias ? userPractitioner.alias :  userPractitioner.name

    const idAdmin = userAdmin.id
    const nameAdmin = userAdmin.alias ? userAdmin.alias :  userAdmin.name

    const [channelId, setChannelId] = React.useState();
    const [modalOpen, setModalOpen] = React.useState(false)
    const [registeredUser, setRegisteredUser] = React.useState(false)

    async function verifyRegisteredUser() {
        const liveUser = UserRepository.getUser(idPractitioner);
        liveUser.on('dataUpdated', user => {
            setRegisteredUser(true)
        });
    }

    function openNotification() {
        const liveToastErrorStartChat = document.getElementById('liveToastErrorStartChat')
        const toastErrorStartChat = bootstrap.Toast.getOrCreateInstance(liveToastErrorStartChat)
        toastErrorStartChat.show()
    }


    async function startChannel() {

        if (registeredUser) {
            const newChannel = {
              displayName: `${namePract} and ${nameUser} `,
              type: ChannelType.Conversation,
              userIds: [idPractitioner]
            };

            const liveChannel = ChannelRepository.createChannel(newChannel);

            liveChannel.once('dataUpdated', model => {
                sessionStorage.setItem("channelIdInit", model.channelId)
                setChannelId(model.channelId)
                setModalOpen(true)
            });

            liveChannel.once('dataError', error => {
               console.log("Error... Try again later")
            });

            return
        }

        const liveToastUserNotRegistered = document.getElementById('liveToastUserNotRegistered')
        const toastUserNotRegistered = bootstrap.Toast.getOrCreateInstance(liveToastUserNotRegistered)
        toastUserNotRegistered.show()

        return;

    }

    async function startChannelAdmin() {

        const newChannel = {
          displayName: `${nameAdmin} and ${nameUser} `,
          type: ChannelType.Conversation,
          userIds: [idAdmin]
        };

        const liveChannel = ChannelRepository.createChannel(newChannel);

        liveChannel.once('dataUpdated', model => {
            sessionStorage.setItem("channelIdInit", model.channelId)
            setChannelId(model.channelId)
            setModalOpen(true)
        });

        liveChannel.once('dataError', error => {
           console.log("Error... Try again later")
        });

    }

    React.useEffect(()=>{
        verifyRegisteredUser()
    },[])


    return (
            <div className="d-flex flex-column align-items-center">
                <ModalChat channelId={channelId} setChannelId={setChannelId} modalOpen={modalOpen} setModalOpen={setModalOpen}/>
                { idAdmin && idAdmin !== idUser
                ?  <button onClick={startChannelAdmin} className="btn_1_bg px-5 fw-bold text-uppercase mb-2" style={{minWidth:'218px',fontSize:'18px'}}>Contact Us</button>
                : ''}
                { idUser && idUser !== idPractitioner
                ? <button onClick={startChannel} className="btn_1 px-5 fw-bold text-uppercase" style={{minWidth:'218px',fontSize:'18px'}}>Start Chat</button>
                : <button type="button" onClick={openNotification} className="btn_1 px-5 fw-bold text-uppercase"  style={{minWidth:'218px',fontSize:'18px'}} id="liveToastBtn">Start Chat</button>}
            </div>
        )
  }

if (document.getElementById('ButtonInitChat')) {
    createRoot(document.getElementById('ButtonInitChat')).render(<ButtonInitChat />)
}
