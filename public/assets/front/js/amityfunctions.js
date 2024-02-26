import { ChannelRepository, ChannelType } from "@amityco/js-sdk"

async function initChannel() {

    const idUser = userWowness.id
    const idPractitioner = userPractitioner.id
    const namePractitioner = userPractitioner.alias ? userPractitioner.alias : userPractitioner.name
    const nameUser = userWowness.alias ? userWowness.alias : userWowness.name

    const newChannel = {
      channelId:`${idUser}+${idPractitioner}`,
      displayName: `${nameUser} and ${namePractitioner}`,
      type: ChannelType.Conversation,
      userIds: [idUser, idPractitioner]
    };

    const liveChannel = ChannelRepository.createChannel(newChannel);

    liveChannel.once('dataUpdated', () => {
        console.log('channel created');
      });

}


const buttonInitChatPractitioner = document.getElementById('buttonInitChatPractitioner')

buttonInitChatPractitioner.addEventListener('click', event => {
    initChannel()
})


