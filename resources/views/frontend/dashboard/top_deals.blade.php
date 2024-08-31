@extends('frontend.layout.homepagenew')
@section('content')

    @section('meta')
        <meta name="robots" content="noindex">
    @endsection

    <style>
        /* Scoped custom styles */
		.custom-container {
			width: 800px;
			margin: 0 auto;
		}
		ul.custom-tabs {
			margin: 0px;
			padding: 0px;
			list-style: none;
		}
		ul.custom-tabs li {
			background: none;
			color: #222;
			display: inline-block;
			padding: 10px 15px;
			cursor: pointer;
		}

		ul.custom-tabs li.custom-current {
			background: #ededed;
			color: #222;
		}

		.custom-tab-content {
			display: none;
			padding: 15px;
		}

		.custom-tab-content.custom-current {
			display: inherit;
		}

        .cmn-table table{
            width: 80%;
            box-sizing: border-box;
            margin: 0px !important;
            margin-left: -10px !important;
        }
        
        .cmn-table{
            width: 700px;
        }

        #custom-tab-1, #custom-tab-2 {
            background-color: #ededed;
            width: 570px;
            /* General styles for all devices */
        }

        /* Apply specific styles only on mobile devices */
        @media screen and (max-width: 768px) {
            #custom-tab-1, #custom-tab-2 {
                overflow-x: scroll;
                overflow-y: hidden;
                white-space: nowrap;
                width: 330px !important;
            }
        }

        .cmn-form > .custom-container {
            width: 100%;
        }

        .top-deal-table {
            width: 100%;
            box-sizing: border-box;
            padding: 0;
        }

        div#custom-tab-1, #custom-tab-2 {
            width: 100% !important;
            box-sizing: border-box;
        }

        .top-deal-table table.content-table {
            width: 100%;
            margin: 0 !important;
        }

        div#timestamp {
            padding: 8px 0;
            font-size: 12px !important;
            text-align: right;
            position: absolute;
            right: 0;
            top: 8px;
        }

        .cmn-form > .custom-container {
            position: relative;
        }
        @media only screen and (max-width:767px){
            div#timestamp {
                position: unset;
                text-align: left;
            }
        }
    </style>

    <section class="main-section full-container">
        <div class="container flex l-gap flex-mobile lr-m">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
            @includeIf('frontend.layout.dashboardsidebar')
            <div class="page-content home">
                <h1 class="page-title">Top 20 Deals</h1>
                <div class="cmn-form">
                    <div class="custom-container">
                        <ul class="custom-tabs">
                            <li class="custom-tab-link custom-current" data-tab="custom-tab-1">Percent</li>
                            <li class="custom-tab-link" data-tab="custom-tab-2">Cash Back</li>
                        </ul>

                        <div id="timestamp" style="font-size: small; font-style: italic;"></div>

                        <div id="custom-tab-1" class="custom-tab-content">
                            <div class="cmn-table top-deal-table">	
                                <table class="content-table" style="border-collapse: collapse; margin: 26px 29px; font-size: 0.9em; min-width: 400px; border-radius: 5px 5px 0 0; overflow: hidden; box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);">
                                        <thead style="background-color: #95bb3c; color: #000000; text-align: left; font-weight: bold;">
                                            <tr>
                                                <th style="padding: 12px 15px;">#</th>
                                                <th style="padding: 12px 15px;">Store Name</th>
                                                <th style="padding: 12px 15px;">Percent</th>
                                                <th style="padding: 12px 15px;">Shop</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($percent as $key=>$track)
                                                <tr style="border-bottom: 1px solid #030303;">
                                                    <td style="padding: 12px 15px;">{{$key+1}}</td>
                                                    <td style="padding: 12px 15px;">{{$track->store_name}}</td>
                                                    <td style="padding: 12px 15px;">{{$track->amount}}</td>
                                                    <td style="padding: 12px 20px;font-size: 20px;"><a title="View Deal" target="_blank" href="{{$track->shopping_url}}" style="text-decoration: none;color: inherit;">&#128722;</a></td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                </table>
                            </div>
                        </div>
                        <div id="custom-tab-2" class="custom-tab-content">
                            <div class="cmn-table top-deal-table">	
                                <table class="content-table" style="border-collapse: collapse; margin: 26px 29px; font-size: 0.9em; min-width: 400px; border-radius: 5px 5px 0 0; overflow: hidden; box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);">
                                        <thead style="background-color: #95bb3c; color: #000000; text-align: left; font-weight: bold;">
                                            <tr>
                                                <th style="padding: 12px 15px;">#</th>
                                                <th style="padding: 12px 15px;">Store Name</th>
                                                <th style="padding: 12px 15px;">Cash back</th>
                                                <th style="padding: 12px 15px;">Shop</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($cashback as $key=>$track)
                                                <tr style="border-bottom: 1px solid #030303;">
                                                    <td style="padding: 12px 15px;">{{$key+1}}</td>
                                                    <td style="padding: 12px 15px;">{{$track->store_name}}</td>
                                                    <td style="padding: 12px 15px;">{{$track->amount}}</td>
                                                    <td style="padding: 12px 20px;font-size: 20px;"><a title="View Deal" target="_blank" href="{{$track->shopping_url}}" style="text-decoration: none;color: inherit;">&#128722;</a></td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var tabs = document.querySelectorAll('.custom-tab-link');
            var contents = document.querySelectorAll('.custom-tab-content');

            tabs.forEach(function(tab) {
                tab.addEventListener('click', function() {
                    var tabId = this.getAttribute('data-tab');

                    tabs.forEach(function(t) {
                        t.classList.remove('custom-current');
                        t.style.border = '1px solid gray'; // Add gray border when class is removed
                    });

                    contents.forEach(function(c) {
                        c.classList.remove('custom-current');
                    });

                    this.classList.add('custom-current');
                    this.style.border = 'none'; // Remove border when class is added
                    document.getElementById(tabId).classList.add('custom-current');
                });
            });

            // Automatically fire click event on the first tab
            if (tabs.length > 0) {
                tabs[0].click();
            }
        });

        document.addEventListener('DOMContentLoaded', function() {
            var now = new Date();
            var dateString = now.toLocaleDateString('en-US');

            // Keep the time constant since the cron job runs at the same time every day
            var timeString = "05:00 AM EDT";  // Adjust this to your desired time and timezone format

            document.getElementById('timestamp').innerHTML = `Updated as of ${timeString} ${dateString}`;
        });

    </script>

    @includeIf('frontend.layout.hero-section')
@endsection
