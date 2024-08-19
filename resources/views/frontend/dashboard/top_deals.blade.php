@extends('frontend.layout.homepagenew')
@section('content')
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
                            <li class="custom-tab-link" data-tab="custom-tab-2">CashBack</li>
                        </ul>

                        <div id="custom-tab-1" class="custom-tab-content">
                            <div class="cmn-table">	
                                <table class="content-table" style="border-collapse: collapse; margin: 26px 29px; font-size: 0.9em; min-width: 400px; border-radius: 5px 5px 0 0; overflow: hidden; box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);">
                                        <thead style="background-color: #95bb3c; color: #000000; text-align: left; font-weight: bold;">
                                            <tr>
                                                <th style="padding: 12px 15px;">#</th>
                                                <th style="padding: 12px 15px;">Store Name</th>
                                                <th style="padding: 12px 15px;">Percent</th>
                                                <th style="padding: 12px 15px;">View Store</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($percent as $key=>$track)
                                                <tr style="border-bottom: 1px solid #030303;">
                                                    <td style="padding: 12px 15px;">{{$key+1}}</td>
                                                    <td style="padding: 12px 15px;">{{$track->store_name}}</td>
                                                    <td style="padding: 12px 15px;">{{$track->amount}}</td>
                                                    <td style="padding: 12px 20px;font-size: 20px;"><a title="View Deal" target="_blank" href="{{$track->shopping_url}}" style="text-decoration: none;color: inherit;">&#128065;</a></td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                </table>
                            </div>
                        </div>
                        <div id="custom-tab-2" class="custom-tab-content">
                            <div class="cmn-table">	
                                <table class="content-table" style="border-collapse: collapse; margin: 26px 29px; font-size: 0.9em; min-width: 400px; border-radius: 5px 5px 0 0; overflow: hidden; box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);">
                                        <thead style="background-color: #95bb3c; color: #000000; text-align: left; font-weight: bold;">
                                            <tr>
                                                <th style="padding: 12px 15px;">#</th>
                                                <th style="padding: 12px 15px;">Store Name</th>
                                                <th style="padding: 12px 15px;">Cashback</th>
                                                <th style="padding: 12px 15px;">View Store</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($cashback as $key=>$track)
                                                <tr style="border-bottom: 1px solid #030303;">
                                                    <td style="padding: 12px 15px;">{{$key+1}}</td>
                                                    <td style="padding: 12px 15px;">{{$track->store_name}}</td>
                                                    <td style="padding: 12px 15px;">{{$track->amount}}</td>
                                                    <td style="padding: 12px 20px;font-size: 20px;"><a title="View Deal" target="_blank" href="{{$track->shopping_url}}" style="text-decoration: none;color: inherit;">&#128065;</a></td>
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

                    tabs.forEach(function(t) { t.classList.remove('custom-current'); });
                    contents.forEach(function(c) { c.classList.remove('custom-current'); });

                    this.classList.add('custom-current');
                    document.getElementById(tabId).classList.add('custom-current');
                });
            });

            // Automatically fire click event on the first tab
            if (tabs.length > 0) {
                tabs[0].click();
            }
        });

    </script>

    @includeIf('frontend.layout.hero-section')
@endsection
