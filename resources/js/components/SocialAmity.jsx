import React from 'react';
import { createRoot } from 'react-dom/client';
import { ApiRegion } from "@amityco/js-sdk";
import { AmityUiKitProvider, AmityUiKitSocial } from "@amityco/ui-kit-open-source";

export default function SocialAmity() {

    const apiKey = "b0e9ed5d6f8fa1344537884f5500478b845f85eab8366a2a"
    const userId = userWowness.id

    return (
        <AmityUiKitProvider key={userId} apiKey={apiKey} userId={userId} apiRegion={ApiRegion.EU}>
            <AmityUiKitSocial />
        </AmityUiKitProvider>
    )
  }

if (document.getElementById('SocialAmity')) {
    createRoot(document.getElementById('SocialAmity')).render(<SocialAmity />)
}
