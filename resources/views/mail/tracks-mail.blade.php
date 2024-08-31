<x-mail::message>
# Happy Greetings From {{ config('app.name') }}

# Hello {{$userName}},

We are excited to inform you that your subscribed store **{{$store}}** has a special offer waiting for you! This offer is available for a limited time, so don't miss out.

Click the button below to view the offer and make the most of this exclusive deal:

<x-mail::button :url="$storeUrl">
View Offer on {{$store}}
</x-mail::button>

## Offer Details:
- **Discount is in {{$discountType == 'Percentage' ? 'Percent' : 'Fixed Value'}}:** {{$offerPercent}}{{ $discountType === 'Percentage' ? '%' : '' }}

Feel free to contact us if you have any questions or need further assistance.

<x-mail::button :url="$url">
View {{ config('app.name') }}
</x-mail::button>

Thanks for being a valued member of {{ config('app.name') }}!

Best regards,
The {{ config('app.name') }} Team
</x-mail::message>
