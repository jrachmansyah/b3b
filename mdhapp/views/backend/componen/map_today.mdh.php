<script>
    (function($) {
        'use strict';
        var initStreetView = function() {
            var gmap = GMaps.createPanorama({
                el: '#gmap-street-view',
                lat: <?= $sett->latitude_kantor; ?>,
                lng: <?= $sett->lang_kantor; ?>
            });

            $(window).on('sidebar-left-toggle', function() {
                google.maps.event.trigger(gmap, 'resize');
            });
        };

        // auto initialize
        $(function() {
            initStreetView();
        });

    }).apply(this, [jQuery]);
</script>
<script>
    if ($("#map_todo_mdh").length > 0) {
        (function(A) {
            if (!Array.prototype.forEach)
                A.forEach =
                A.forEach ||
                function(action, that) {
                    for (var i = 0, l = this.length; i < l; i++)
                        if (i in this) action.call(that, this[i], i, this);
                };
        })(Array.prototype);

        var mapObject,
            markers = [],
            markersData = {
                Marker: [
                    <?php if (count($absensi->result()) > 0) {
                        foreach ($absensi->result() as $qmap) { ?> {
                                name: "Check In",
                                location_latitude: <?= $qmap->latitude_masuk; ?>,
                                location_longitude: <?= $qmap->long_masuk; ?>,
                                map_image_url: "<?= base_url(); ?><?= $qmap->image_masuk; ?>",
                                map_marker: "<?= base_url(); ?>mdhdesign/map/5.png",
                                name_point: "<?= $qmap->nama_awal; ?> <?= $qmap->nama_akhir; ?>",
                            },
                    <?php }
                    } ?>
                ],
            };

        var mapOptions = {
            zoom: 15,
            <?php if (count($q1->result()) == 1) {
                foreach ($q1->result() as $qq) { ?>
                    center: new google.maps.LatLng(<?= $qq->latitude_masuk; ?>, <?= $qq->long_masuk; ?>),
            <?php }
            } ?>
            mapTypeId: google.maps.MapTypeId.ROADMAP,

            mapTypeControl: false,
            mapTypeControlOptions: {
                style: google.maps.MapTypeControlStyle.DROPDOWN_MENU,
                position: google.maps.ControlPosition.LEFT_CENTER,
            },
            panControl: false,
            panControlOptions: {
                position: google.maps.ControlPosition.TOP_RIGHT,
            },
            zoomControl: true,
            zoomControlOptions: {
                position: google.maps.ControlPosition.RIGHT_BOTTOM,
            },
            scrollwheel: false,
            scaleControl: false,
            scaleControlOptions: {
                position: google.maps.ControlPosition.TOP_LEFT,
            },
            streetViewControl: true,
            streetViewControlOptions: {
                position: google.maps.ControlPosition.LEFT_TOP,
            },
            styles: [{
                    featureType: "administrative",
                    elementType: "labels.text.fill",
                    stylers: [{
                        color: "#444444",
                    }, ],
                },
                {
                    featureType: "landscape",
                    elementType: "all",
                    stylers: [{
                        color: "#f2f2f2",
                    }, ],
                },
                {
                    featureType: "poi",
                    elementType: "all",
                    stylers: [{
                        visibility: "off",
                    }, ],
                },
                {
                    featureType: "road",
                    elementType: "all",
                    stylers: [{
                            saturation: -100,
                        },
                        {
                            lightness: 45,
                        },
                    ],
                },
                {
                    featureType: "road.highway",
                    elementType: "all",
                    stylers: [{
                        visibility: "simplified",
                    }, ],
                },
                {
                    featureType: "road.arterial",
                    elementType: "labels.icon",
                    stylers: [{
                        visibility: "off",
                    }, ],
                },
                {
                    featureType: "transit",
                    elementType: "all",
                    stylers: [{
                        visibility: "off",
                    }, ],
                },
                {
                    featureType: "water",
                    elementType: "all",
                    stylers: [{
                            color: "#cfcfcf",
                        },
                        {
                            visibility: "on",
                        },
                    ],
                },
            ],
        };
        var marker;
        mapObject = new google.maps.Map(
            document.getElementById("map_todo_mdh"),
            mapOptions
        );
        for (var key in markersData)
            markersData[key].forEach(function(item) {
                marker = new google.maps.Marker({
                    position: new google.maps.LatLng(
                        item.location_latitude,
                        item.location_longitude
                    ),
                    map: mapObject,
                    icon: item.map_marker,
                });
                if ("undefined" === typeof markers[key]) markers[key] = [];
                markers[key].push(marker);
                google.maps.event.addListener(marker, "click", function() {
                    closeInfoBox();
                    getInfoBox(item).open(mapObject, this);
                    mapObject.setCenter(
                        new google.maps.LatLng(
                            item.location_latitude,
                            item.location_longitude
                        )
                    );
                });
            });

        new MarkerClusterer(mapObject, markers[key]);

        function hideAllMarkers() {
            for (var key in markers)
                markers[key].forEach(function(marker) {
                    marker.setMap(null);
                });
        }

        function closeInfoBox() {
            $("div.infoBox").remove();
        }

        function getInfoBox(item) {
            return new InfoBox({
                content: '<div class="marker_info" id="marker_info">' +
                    '<div class="thumb"><img src="' +
                    item.map_image_url +
                    '" alt=""/><a href="#" class="save"><i class="fa fa-heart"></i>save</a></div>' +
                    "<div>" +
                    '<h3>' +
                    item.name_point +
                    "</a></h3>" +
                    "</span>" +
                    "</div>" +
                    "</div>" +
                    "</div>" +
                    "</div>",
                disableAutoPan: false,
                maxWidth: 0,
                pixelOffset: new google.maps.Size(10, 92),
                closeBoxMargin: "",
                isHidden: false,
                alignBottom: true,
                pane: "floatPane",
                enableEventPropagation: true,
            });
        }

        function onHtmlClick(location_type, key) {
            google.maps.event.trigger(markers[location_type][key], "click");
        }
    }
</script>