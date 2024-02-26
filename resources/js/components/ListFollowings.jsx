import React from 'react';
import { createRoot } from 'react-dom/client';
import { UserRepository, FollowRequestStatus  } from "@amityco/js-sdk";
import ButtonUnfollow from './ButtonUnfollow';

export default function ListFollowings() {

    const [followersList, setFollowersList] = React.useState()
    const [statusFollow, setStatusFollow] = React.useState(true)
    const [loading, setLoading] = React.useState(true)

    const getFollowingsList = async () => {
        const liveFollowersList = await UserRepository.getFollowings(
            userWowness.id,
            FollowRequestStatus.Accepted,
          );

        const FollowersList = await liveFollowersList.once('dataUpdated', data => {
                setFollowersList(data)
                setLoading(false)
          });
    }

    React.useEffect(()=>{
        setTimeout(()=> getFollowingsList(), 800)
    },[statusFollow])

    return (
        <div className='p-3'>
            <div className='row'>
                {loading
                ? <div className="text-center">Loading...</div>
                : followersList?.map( follower =>
                    (
                    <div key={follower.userId} className="col-md-4 d-flex align-items-center py-2">
                        <img src={follower.avatarCustomUrl} alt={follower.displayName} style={{width:'100px',height:'100px',objectFit:'cover',borderRadius:'65px',marginRight:'10px'}} />
                        <div>
                            <h5 className='m-0'>{follower.displayName}</h5>
                            <a href={`/practitioner/${follower.userId}`} className="mb-0">See Profile</a>
                            <ButtonUnfollow setStatusFollow={setStatusFollow} setLoading={setLoading} follower={follower}/>
                        </div>
                    </div>
                    )
                )}
            </div>
        </div>
    )
  }

if (document.getElementById('ListFollowings')) {
    createRoot(document.getElementById('ListFollowings')).render(<ListFollowings />)
}
