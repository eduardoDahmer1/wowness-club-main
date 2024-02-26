import React from 'react';
import { createRoot } from 'react-dom/client';
import { UserRepository } from "@amityco/js-sdk";

export default function ButtonUnfollow({setStatusFollow, follower, setLoading}) {

    const unfollowUser = async () => {
        setLoading(true)
        const success = await UserRepository.followDecline(follower.userId);
        setStatusFollow(false)
    }

    return (
        <div>
            <button onClick={unfollowUser} className="btn_following fw-bold" style={{fontSize: '.8rem', marginTop:'7px'}}><i className="bi bi-person-dash-fill me-1"></i> Unfollow</button>
        </div>
    )
  }

if (document.getElementById('ButtonUnfollow')) {
    createRoot(document.getElementById('ButtonUnfollow')).render(<ButtonUnfollow />)
}
