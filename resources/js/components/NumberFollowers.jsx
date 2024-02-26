import React from 'react';
import { createRoot } from 'react-dom/client';
import { UserRepository, FollowRequestStatus  } from "@amityco/js-sdk";

export default function NumberFollowers() {

    const [numberfollowers, setNumberfollowers] = React.useState()

    const getFollowingsList = async () => {
        const liveFollowersList = await UserRepository.getFollowings(
            userWowness.id,
            FollowRequestStatus.Accepted,
          );

        const FollowersList = await liveFollowersList.once('dataUpdated', data => {
            setNumberfollowers(data.length)
          });
    }

    React.useEffect(()=>{
        setTimeout(()=> getFollowingsList(), 800)
    },[])

    return (
        <div className='p-3'>
            <p className='text-center m-0'><strong>{numberfollowers}</strong> followers</p>
        </div>
    )
  }

if (document.getElementById('NumberFollowers')) {
    createRoot(document.getElementById('NumberFollowers')).render(<NumberFollowers />)
}
