import React from 'react';
import { createRoot } from 'react-dom/client';
import { UserRepository, FollowRequestStatus  } from "@amityco/js-sdk";
import loadingImage from "../images/loading.gif"

export default function ButtonFollow() {

    const [statusFollow, setStatusFollow] = React.useState(false)
    const [loading, setLoading] = React.useState(false)

    const idUser = userWowness.id
    const idPractitioner = userPractitioner.id

    const alertPlaceholder = document.getElementById('liveAlertPlaceholder')

    const appendAlert = (message, type) => {
    const wrapper = document.createElement('div')
    wrapper.innerHTML = [
        `<div class="alert alert-${type} alert-dismissible mt-2" role="alert">`,
        `   <div>${message}</div>`,
        '   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>',
        '</div>'
    ].join('')

    alertPlaceholder.append(wrapper)
    }

    const followUser = async () => {
        try {
            setLoading(true)
            const success = await UserRepository.follow(userPractitioner.id);
            setLoading(false)
            setStatusFollow(true)
        }
        catch {
            setLoading(false)
            const liveToastUserNotRegistered = document.getElementById('liveToastUserNotRegistered')
            const toastUserNotRegistered = bootstrap.Toast.getOrCreateInstance(liveToastUserNotRegistered)
            toastUserNotRegistered.show()
        }
    }

    const unfollowUser = async () => {
        setLoading(true)
        const success = await UserRepository.followDecline(userPractitioner.id);
        setLoading(false)
        setStatusFollow(false)
    }

    const getFollowingsList = async () => {
        const liveFollowersList = await UserRepository.getFollowings(
            userWowness.id,
            FollowRequestStatus.Accepted,
          );

        const FollowersList = await liveFollowersList.once('dataUpdated', data => {
                data.map( follower => {
                    if (follower.userId == userPractitioner.id) {
                        setStatusFollow(true)
                    }
                })
          });
    }

    function openNotification() {
        const liveToastErrorFollow = document.getElementById('liveToastErrorFollow')
        const toastErrorFollow = bootstrap.Toast.getOrCreateInstance(liveToastErrorFollow)
        toastErrorFollow.show()
    }

    React.useEffect(()=>{
        setTimeout(()=> getFollowingsList(), 800)
    },[statusFollow])

    if(idUser && idUser == idPractitioner) {
        return (
            <button onClick={openNotification} className="btn_follow fw-bold">
                <i className="bi bi-person-plus-fill me-1"></i> Follow
            </button>
        )
    }

    if (statusFollow) {
        return (
            <>{ loading
                    ? <button className="btn_following fw-bold">
                        <img width="25px" src="../images/loading.gif"/>
                     </button>

                    : <button onClick={unfollowUser} className="btn_following fw-bold">
                        <i className="bi bi-check2 me-1"></i> Following
                      </button>
                }
            </>
        )
    }

    return (
        <>{ loading
            ? <button className="btn_follow fw-bold">
                <img width="25px" src="../images/loading.gif"/>
              </button>

            : <button onClick={followUser} className="btn_follow fw-bold">
                <i className="bi bi-person-plus-fill me-1"></i> Follow
              </button>
            }
        </>
    )

  }

if (document.getElementById('ButtonFollow')) {
    createRoot(document.getElementById('ButtonFollow')).render(<ButtonFollow />)
}
