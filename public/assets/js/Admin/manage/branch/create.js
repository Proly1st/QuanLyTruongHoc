let marker_map = [];
function openModalCreateBranch()
{
    $('#modal-create-branch').modal('show');
}

var map;

function initMap() {
    // Create map
    map = new google.maps.Map(document.getElementById('map'), {
        center: {lat: 30.266666, lng: -97.733330},
        zoom: 8
    });

    // Reset the value of the search box
    document.getElementById('address-branch').value = '';

    var input = document.getElementById('address-branch');
    // Create new searchbox constructor
    var searchName = new google.maps.places.SearchBox(input);
    // Set search to stay within bounds first
    map.addListener('bounds_changed', function() {
        searchName.setBounds(map.getBounds());
    })

    // Array to hold search options
    var markers = [];

    // When user selects prediction from list
    searchName.addListener('places_changed', function() {
        // Var to get places
        var places = searchName.getPlaces();

        // If no places then just return (do nothing)
        if (places.length === 0) {
            return;
        }

        // Clear previous markers
        markers.forEach(function (m) { m.setMap(null); });

        // Reset markers array
        markers = [];

        // bounds object
        var bounds = new google.maps.LatLngBounds();

        places.forEach(function (p) {
            // If no data then just return (do nothing)
            if (!p.geometry) {
                return;
            }
            // push marker with data
            markers.push(new google.maps.Marker({
                map: map,
                title: p.title,
                position: p.geometry.location
            }));

            if (p.geometry.viewport) {
                bounds.union(p.geometry.viewport);
            } else {
                bounds.extend(p.geometry.location);
            }
        });
        map.fitBounds(bounds);
        geocodeAddress();
    });

}

function geocodeAddress() {
    let geocoder = new google.maps.Geocoder;
    geocoder.geocode({'address':$('#address-branch').val(),region:'no'}, function (results, status) {
        if (status === google.maps.GeocoderStatus.OK) {
            map.setCenter(results[0].geometry.location);
            let marker = new google.maps.Marker({
                map: map,
                position: results[0].geometry.location,
                draggable: true,
            });
            marker_map = [];
            let item_or = {};
            item_or.lat = results[0].geometry.location.lat();
            item_or.lng = results[0].geometry.location.lng();
            marker_map.push(item_or);
            console.log(marker_map);

        } else {
            console.log('Geocode was not successful for the following reason: ' + status);
        }
    });
}


async function create(){
    checkEmptyTemplate('#modal-create-branch');
    checkPhoneTemplate('#modal-create-branch');
    checkSelectTemplate('#modal-create-branch');
    let method = 'post',
    url = 'create-branch',
    data = {
        name : $('#name-branch').val(),
        email : $('#email-branch').val(),
        phone : $('#phone-branch').val(),
        address: $('#address-branch').val(),
        local : marker_map,
    },
    param = null;
    let res = await templateCallAjax(method,url,data,param);
    if(res.success === '200'){
        let title = 'Thông Báo',
            text = 'Thêm mới thành công';
        SwalSuccess(title,text);
        loadData();
        CloseModalCreateBranch();
    }
    else{
        $('#phone-branch').removeClass('is-valid');
        $('#phone-branch').addClass('is-invalid');
        $('#phone-branch').parent().children('.error-message').text(res.error);
    }
}

function CloseModalCreateBranch(){
    $('#modal-create-branch').modal('hide');
    $('#select-branch option:selected').val(''),
    $('#name-branch').val(''),
    $('#email-branch').val(''),
    $('#phone-branch').val(''),
    $('#address-branch').val('');
}
