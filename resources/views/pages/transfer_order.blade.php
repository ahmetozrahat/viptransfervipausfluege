@extends('main')
@section('content')
    <!-- Page Header Section -->
    <div class="page-header about-us">
        <div id="transfer-page-title" class="page-title" style="text-align: left;">
            {{__('transfer_order_title')}}
        </div>
    </div>

    <!-- Form Section -->
    <form action="#" class="order-form" id="order-form" method="POST">
        @csrf
        <input id="transfer-direction-value" type="hidden" value="{{$formData['direction']}}"/>
        <div class="order-container">
            <div id="order-info-text" class="order-info-text">
                {{__('transfer_order_page_info')}}
            </div>
            <div class="order-form-section">
                <div class="order-left">
                    <div class="order-left-personal">
                        <div id="order-personal-title" class="order-title">
                            {{__('transfer_order_personal_info')}}
                        </div>
                        <div class="order-info">
                            <div class="order-row">
                                <label id="order-personal-name-label" for="order-personal-name" class="form-label">{{__('transfer_order_name')}}</label>
                                <input type="text" class="form-control" id="order-personal-name" name="name" aria-describedby="name" required>
                            </div>
                            <div class="order-row">
                                <label id="order-personal-email-label" for="order-personal-email" class="form-label">{{__('transfer_order_email')}}</label>
                                <input type="email" class="form-control" id="order-personal-email" name="email" aria-describedby="email" required>
                            </div>
                        </div>
                        <div class="order-info">
                            <div class="order-row">
                                <label id="order-personal-phone-label" for="order-personal-phone" class="form-label">{{__('transfer_order_phone')}}</label>
                                <input type="tel" class="form-control" id="order-personal-phone" name="phone" aria-describedby="phone" required autocomplete="off">
                            </div>
                            <div class="order-row">
                                <label id="order-personal-country-label" for="order-personal-country" class="form-label">{{__('transfer_order_country')}}</label>
                                <select class="form-control" id="order-personal-country" name="country" required>
                                    @foreach($countries as $country)
                                        <option value="{{$country->id}}">{{$country->country_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="order-left-flight">
                        <div id="order-flight-title" class="order-title">
                            {{__('transfer_order_flight_info')}}
                        </div>
                        <div class="order-info">
                            <div class="order-row">
                                <div class="order-row">
                                    <label id="order-flight-date-label" for="order-flight-date" class="form-label">{{__('transfer_order_flight_date')}}</label>
                                    <input type="text" class="form-control" id="order-flight-date" name="flight-date" aria-describedby="flight_date" required autocomplete="off">
                                </div>
                                <div class="order-row">
                                    <label id="order-flight-time-label" class="form-label alone">{{__('transfer_order_flight_time')}}</label>
                                    <div class="order-row">
                                        <select class="form-control" name="flight-hour" id="order-flight-hour" required>
                                            @for ($i = 0; $i < 24; $i++)
                                                <option value="{{$i}}">{{$i}}</option>
                                            @endfor
                                        </select>
                                    </div>
                                    <div class="order-row">
                                        <select class="form-control no-title" name="flight-minute" id="order-flight-minute" required>
                                            @for ($i = 0; $i < 12; $i++)
                                                <option value="{{$i*5}}">{{sprintf("%02d", $i * 5)}}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="order-row">
                                <div class="order-row">
                                    <label id="order-flight-no-label" for="order-flight-no" class="form-label">{{__('transfer_order_flight_no')}}</label>
                                    <input type="text" class="form-control" id="order-flight-no" aria-describedby="flight-no" name="flight-no" required>
                                </div>
                                <div class="order-row">
                                    <label id="order-flight-terminal-label" for="order-flight-terminal" class="form-label">{{__('transfer_order_terminal')}}</label>
                                    <select class="form-control" id="order-flight-terminal" name="terminal">
                                        @foreach($terminals as $terminal)
                                            <option value="{{$terminal->id}}">{{$terminal->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="order-info">

                            @if ($formData['direction'] == 3)
                                <div class="order-row">
                                    <div class="order-row">
                                        <label id="order-transfer-date-label" for="order-transfer-date" class="form-label">{{__('transfer_order_transfer_date')}}</label>
                                        <input type="text" class="form-control" id="order-transfer-date" aria-describedby="transfer_date" name="transfer-date" required autocomplete="off">
                                    </div>
                                    <div class="order-row">
                                        <label id="order-transfer-time-label" class="form-label alone">{{__('transfer_order_transfer_time')}}</label>
                                        <div class="order-row">
                                            <select class="form-control" name="order-transfer-hour" id="order-transfer-hour" name="transfer-hour" required>
                                                @for ($i = 0; $i < 24; $i++)
                                                    <option value="{{$i}}">{{$i}}</option>
                                                @endfor
                                            </select>
                                        </div>
                                        <div class="order-row">
                                            <select class="form-control no-title" name="order-transfer-minute" id="order-transfer-minute" name="transfer-minute" required>
                                                @for ($i = 0; $i < 12; $i++)
                                                    <option value="{{$i*5}}">{{sprintf("%02d", $i * 5)}}</option>
                                                @endfor
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="order-row">
                                    <label id="order-transfer-point-label" for="order-transfer-point" class="form-label">{{__('transfer_order_transfer_point')}}</label>
                                    <input type="text" class="form-control" id="order-transfer-point" name="transfer-point" aria-describedby="transfer_point" required>
                                </div>
                            @else
                                <div class="order-row single-row">
                                    <label id="order-transfer-point-label" for="order-transfer-point" class="form-label">{{__('transfer_order_transfer_point')}}</label>
                                    <input type="text" class="form-control" id="order-transfer-point" name="transfer-point" aria-describedby="transfer_point" required>
                                </div>
                            @endif
                        </div>
                        <div class="order-row single">
                            <label id="order-transfer-notes-label" for="order-transfer-notes" class="form-label">{{__('transfer_order_notes')}}</label>
                            <textarea type="text" class="form-control" id="order-transfer-notes" name="transfer-notes" aria-describedby="transfer_notes" required></textarea>
                        </div>
                    </div>

                    @if ($formData['direction'] == 1)
                        {{-- Transfer with Return --}}
                        <div class="order-left-flight">
                            <div id="order-flight-title2" class="order-title">
                                {{__('transfer_order_flight_info2')}}
                            </div>
                            <div class="order-info">
                                <div class="order-row">
                                    <div class="order-row">
                                        <label id="order-flight-date-label2" for="order-flight-date2" class="form-label">{{__('transfer_order_flight_date2')}}</label>
                                        <input type="text" class="form-control" id="order-flight-date2" name="flight-date2" aria-describedby="flight_date" required autocomplete="off">
                                    </div>
                                    <div class="order-row">
                                        <label id="order-flight-time-label2" class="form-label alone">{{__('transfer_order_flight_time2')}}</label>
                                        <div class="order-row">
                                            <select class="form-control" name="flight-hour2" id="order-flight-hour2" required>
                                                @for($i = 0; $i < 24; $i++)
                                                    <option value="{{$i}}">{{$i}}</option>
                                                @endfor
                                            </select>
                                        </div>
                                        <div class="order-row">
                                            <select class="form-control no-title" name="flight-minute2" id="order-flight-minute2" required>
                                                @for($i = 0; $i < 12; $i++)
                                                    <option value="{{$i*5}}">{{sprintf("%02d", $i * 5)}}</option>
                                                @endfor
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="order-row">
                                    <div class="order-row">
                                        <label id="order-flight-no-label2" for="order-flight-no2" class="form-label">{{__('transfer_order_flight_no2')}}</label>
                                        <input type="text" class="form-control" id="order-flight-no2" aria-describedby="flight-no" name="flight-no2" required>
                                    </div>
                                    <div class="order-row">
                                        <label id="order-flight-terminal-label2" for="order-flight-terminal2" class="form-label">{{__('transfer_order_terminal2')}}</label>
                                        <select class="form-control" id="order-flight-terminal2" name="terminal2">
                                            @foreach($terminals as $terminal)
                                                <option value="{{$terminal->id}}">{{$terminal->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="order-info">
                                <div class="order-row">
                                    <div class="order-row">
                                        <label id="order-transfer-date-label2" for="order-transfer-date2" class="form-label">{{__('transfer_order_transfer_date2')}}</label>
                                        <input type="text" class="form-control" id="order-transfer-date2" aria-describedby="transfer_date" name="transfer-date2" required autocomplete="off">
                                    </div>
                                    <div class="order-row">
                                        <label id="order-transfer-time-label2" class="form-label alone">{{__('transfer_order_transfer_time2')}}</label>
                                        <div class="order-row">
                                            <select class="form-control" id="order-transfer-hour2" name="transfer-hour2" required>
                                                @for($i = 0; $i < 24; $i++)
                                                    <option value="{{$i}}">{{$i}}</option>
                                                @endfor
                                            </select>
                                        </div>
                                        <div class="order-row">
                                            <select class="form-control no-title" id="order-transfer-minute2" name="transfer-minute2" required>
                                                @for($i = 0; $i < 12; $i++)
                                                    <option value="{{$i*5}}">{{sprintf("%02d", $i * 5)}}</option>
                                                @endfor
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="order-row">
                                    <label id="order-transfer-point-label2" for="order-transfer-point2" class="form-label">{{__('transfer_order_transfer_point2')}}</label>
                                    <input type="text" class="form-control" id="order-transfer-point2" name="transfer-point2" aria-describedby="transfer_point" required>
                                </div>
                            </div>
                            <div class="order-row single">
                                <label id="order-transfer-notes-label2" for="order-transfer-notes2" class="form-label">{{__('transfer_order_notes2')}}</label>
                                <textarea type="text" class="form-control" id="order-transfer-notes2" name="transfer-notes2" aria-describedby="transfer_notes" required></textarea>
                            </div>
                        </div>
                    @endif
                    <div class="order-payment">
                        <div id="order-payment-title" class="order-title">
                            {{__('transfer_order_payment_choice')}}
                        </div>
                        <div class="form-check payment-check">
                            <input class="form-check-input" type="radio" name="payment-method-cash" id="payment-method-cash" checked>
                            <label id="order-payment-cash-label" class="form-check-label" for="paymentCash">
                                {{__('transfer_order_payment_cash')}}
                            </label>
                        </div>
                    </div>
                    <div class="order-agreement">
                        <table class="order-agreement-table">
                            <tbody>
                            <tr>
                                <td>
                                    <input class="form-check-input" type="checkbox" name="order-agreement-checkbox1" value="true" id="order-agreement-checkbox1" required>
                                    <label id="order-agreement-label1" class="form-check-label" for="order-agreement-checkbox1">
                                        {!! __('transfer_order_agreement_label1') !!}
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input class="form-check-input" type="checkbox" name="order-agreement-checkbox2" value="true" id="order-agreement-checkbox2">
                                    <label id="order-agreement-label2" class="form-check-label" for="order-agreement-checkbox2">
                                        {{__('transfer_order_agreement_label2')}}
                                    </label>

                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <!-- Modal -->
                        <div id="agreement-modal" class="modal fade" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-xl">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Transfer Sözleşmesi</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="icerik" align="justify">
                                            <h3>1- Taraflar</h3>
                                            <p>Web Sitesi :&nbsp;www.viptransfervipausfluege.com</p>
                                            <p>Online rezervasyon tabanlı hizmet veren web sitesi ve firma “Hizmet Sağlayıcı” olarak anılacaktır.&nbsp; Online rezervasyonda adı-soyadı geçen kişi, aynı rezervasyon içinde temsil ettiği diğer yolcularla beraber, “Müşteri” olarak anılacaktır.</p>
                                            <h3>2- Konu</h3>
                                            <p>İş bu sözleşme “Hizmet Sağlayıcı” &nbsp;ile “Müşteri” arasında yapılmıştır. “Hizmet Sağlayıcı”nın verdiği hizmet, rezervasyon kaydı yapılarak alınmış olup, hizmet içeriliği web sitesi içindeki ilgili sayfalarda detaylı anlatılmıştır.</p>
                                            <h3>3- Sözleşmenin Süresi</h3>
                                            <p>İş bu sözleşme; söz konusu rezervasyonun “Hizmet Sağlayıcı” tarafından onaylandığı andan itibaren, rezervasyonda “Müşteri” tarafından belirtilen hizmet tarihi ve saatinde transferin hizmetinin gerçekleştirilmesini takiben sona erer.</p>
                                            <h3>4- Ödeme ve Fatura Bilgileri</h3>
                                            <p>Rezervasyon esnasında araçta nakit ödeme seçeneği seçilmiş ise “Müşteri” hizmet bedelini hizmeti aldığı esnada ödemekle yükümlüdür. Fatura talebinin rezervasyon formundaki Not bölümünde belirtilmesi halinde fatura araçta teslim edilecektir.</p>
                                            <h3>5- İptal, Değişiklik ve İade Prosedürü</h3>
                                            <ul>
                                                <li>“Müşteri”, hizmetin başlamasına 24 saatten fazla süre varken hizmeti iptal etmek isterse ödediği hizmet bedelinin tamamı kendisine iade edilir.</li>
                                                <li>“Müşteri”, hizmetin başlamasına 12-24 saat kala hizmeti iptal etmek isterse hizmet bedelinin&nbsp;<strong>%75’</strong>i iade edilir.</li>
                                                <li>“Müşteri”, hizmetin başlamasına 1-12 saat kala hizmeti iptal etmek isterse hizmet bedelinin&nbsp;<strong>%50</strong>’si iade edilir.</li>
                                                <li>“Müşteri”, hizmet başlamasına 1 saat kala yaptığı iptallerde veya hizmeti kullanmadığı durumlarda iade yapılmaz. Ancak bir sonraki transfer talebinde tek yön için&nbsp;<strong>%50 indirim</strong>&nbsp;uygulanır. (İndirim uygulanabilmesi için “Müşteri”nin yeni transfer siparişinin Not bölümünde geçmiş rezervasyonun iptali ile ilgili bilgi vermesi gerekmektedir.)</li>
                                            </ul>
                                            <h3>6- Genel hükümler</h3>
                                            <p>Hizmet Sağlayıcı, hizmetin verilmesine engel teşkil edecek durumlarda (Trafik kazası, trafık sıkışıklığı, mekanik arıza, hava muhalefeti, güvenlik önlemleri vb.) transferin gerçekleşemeyeceği anlaşıldığı anda farklı bir araç yönlendirmeye çalışacak ve “Müşteri”ye durum bilgisi verilecektir. Eğer araç temini yapılamazsa alınan hizmet bedelinin tamamı iade edilecek ve bir sonraki transfer siparişinin tek yön fiyatına&nbsp;<strong>%50 indirim</strong>&nbsp;uygulanacaktır. Transfer hizmeti alan tüm yolcular sigortalanmış olup, olası bir kaza ve yaralanma durumunda sağlık masrafları sigorta poliçesinin sağladığı limitler kapsamında karşılanmaktadır.</p>
                                            <h3>7- Yürürlük</h3>
                                            <p>İş bu sözleşme 7 ana maddeden oluşmakta olup, gerektiği takdirde 2 nüsha halinde tanzim edilerek taraflarca imzalanacak olup, sözleşmeden kaynaklanan anlaşmazlıklarda, 4925 Sayılı Karayolu Taşıma Kanununu maddeleri uygulanır. Bu sözleşmeden doğacak olan uyuşmazlık konusunda ..... Mahkemesi ve icra daireleri yetkilidir. Sözleşmeyi kendim ve/veya rezervasyon formunda belirtmiş olduğum isimleri yazılı kişiler adına okuyup, kabul ettiğimi beyan ettim. Bu beyanım; rezervasyon işlemini kendim yerine bir başkasının yürütmüş ve/veya kabul etmiş olması halinde dahi geçerlidir. “Müşteri” olarak adımıza düzenlenmiş olan Hizmet Sözleşmesi ve “Şartlar ve Koşullar” sayfalarında belirtilen hükümlerinin tamamını, göndermiş olduğum rezervasyon formunda yer alan bilgilerimin doğruluğunun sorumluluğunu, 4925 Sayılı Karayolu Taşıma Kanununu ve Taşımacının web sitesindeki bilgileri okuyup, anlayıp kabul ettiğimi beyan ederim.</p>
                                            <div class="temizle"></div>
                                            <ul id="fotogaleri">

                                            </ul>
                                            <div class="temizle"></div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kapat</button>
                                        <button id="agreement-accept" type="button" class="btn btn-primary">Kabul Ediyorum</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button id="order-send-button" type="submit" class="btn btn-dark btn-lg order-send">{{__('transfer_order_send')}}</button>
                </div>
                <div class="order-right">
                    <div id="transfer-selections-title" class="order-title">
                        {{__('transfer_selections')}}
                    </div>
                    <ul class="order-selections">
                        <li class="order-selection gray">
                            <input type="hidden" name="direction" value="{{$formData['direction']}}">
                            <i class="fas fa-directions order-selection-icon"></i>
                            <div id="transfer-selections-direction" class="order-selection-title">{{__('transfer_selections_direction')}}</div>
                            <div id="order-selection-direction" class="order-selection-text">
                                @switch($formData['direction'])
                                    @case(1)
                                        {{__('booking_section_col1_option1')}}
                                        @break
                                    @case(2)
                                        {{__('booking_section_col1_option2')}}
                                        @break
                                    @case(3)
                                        {{__('booking_section_col1_option_3')}}
                                        @break
                                    @default
                                        {{__('undefined')}}
                                        @break
                                @endswitch
                            </div>
                        </li>
                        <li class="order-selection">
                            <input type="hidden" name="airport" value="{{$formData['airport']}}">
                            <i class="fas fa-plane order-selection-icon"></i>
                            <div id="transfer-selections-airport" class="order-selection-title">{{__('transfer_selections_airport')}}</div>
                            <div class="order-selection-text">{{$formData['airportName']}}</div>
                        </li>
                        <li class="order-selection gray">
                            <input type="hidden" name="destination" value="{{$formData['transferPoint']}}">
                            <i class="fas fa-map-marker-alt order-selection-icon"></i>
                            <div id="transfer-selections-transfer-point" class="order-selection-title">{{__('transfer_selections_transfer_point')}}</div>
                            <div class="order-selection-text">{{$formData['transferPointName']}}</div>
                        </li>
                        <li class="order-selection">
                            <i class="fas fa-route order-selection-icon"></i>
                            <div id="transfer-selections-distance" class="order-selection-title">{{__('transfer_selections_distance')}}</div>
                            <div id="order-selection-distance" class="order-selection-text">{{__('undefined')}}</div>
                        </li>
                        <li class="order-selection gray">
                            <input type="hidden" name="passengers" value="{{$formData['adultQuantity'] + $formData['kidQuantity'] + $formData['babyQuantity']}}">
                            <i class="fas fa-users order-selection-icon"></i>
                            <div id="transfer-selections-passengers" class="order-selection-title">{{__('transfer_selections_passengers')}}</div>
                            <div id="order-selection-passenger-count" class="order-selection-text">
                                @if ($formData['adultQuantity'] > 0)
                                    {{ trans_choice('passenger_adult_count', $formData['adultQuantity'], ['count' => $formData['adultQuantity']]) . ', ' }}
                                @endif
                                @if ($formData['kidQuantity'] > 0)
                                    {{ trans_choice('passenger_kid_count', $formData['kidQuantity'], ['count' => $formData['kidQuantity']]) . ', ' }}
                                @endif
                                @if ($formData['babyQuantity'] > 0)
                                    {{ trans_choice('passenger_baby_count', $formData['babyQuantity'], ['count' => $formData['babyQuantity']]) }}
                                @endif
                            </div>
                        </li>
                        <li class="order-selection">
                            <input type="hidden" name="vehicle" value="{{$formData['vehicle']}}">
                            <i class="fas fa-car order-selection-icon"></i>
                            <div id="transfer-selections-vehicle" class="order-selection-title">{{__('transfer_selections_vehicle')}}</div>
                            <div class="order-selection-text">{{$formData['vehicleName']}}</div>
                        </li>
                        <li class="order-selection gray">
                            <i class="fas fa-wallet order-selection-icon"></i>
                            <div id="transfer-selections-price" class="order-selection-title">{{__('transfer_selections_price')}}</div>
                            <div id="transfer-order-price" class="order-selection-text">{{$formData['price']}}</div>
                        </li>
                        <li class="order-selection">
                            <input type="hidden" name="baby-seat" value="{{$formData['babySeat']}}">
                            <i class="fas fa-baby order-selection-icon"></i>
                            <div id="transfer-selections-baby-seat" class="order-selection-title">{{__('transfer_selections_baby_seat')}}</div>
                            <div id="transfer-order-baby-seat-price" class="order-selection-text">{{$formData['babySeat']}}</div>
                        </li>
                        <li class="order-selection green">
                            <i class="fas fa-percent order-selection-icon" style="color: white;"></i>
                            <div id="transfer-selections-discount-coupon" class="order-selection-title">{{__('transfer_selections_coupon')}}</div>
                            <div class="order-selection-text">
                                <input class="order-discount" type="text" id="order-selection-discount">
                            </div>
                        </li>
                        <li class="order-selection">
                            <i class="fas fa-percentage order-selection-icon"></i>
                            <div id="transfer-selections-discount" class="order-selection-title">{{__('transfer_selections_discount')}}</div>
                            <div id="transfer-order-discount" class="order-selection-text">0</div>
                        </li>
                        <li class="order-selection last">
                            <input type="hidden" name="price" value="{{$formData['price']}}">
                            <i class="fas fa-wallet order-selection-icon last"></i>
                            <div id="transfer-selections-final-amount" class="order-selection-title">{{__('transfer_selections_total')}}</div>
                            <div id="transfer-order-total" class="order-selection-text last-price">{{$formData['price']}}</div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </form>
@endsection
@section('scripts')
    <script src="{{mix('js/transfer_order.js')}}"></script>
@endsection
