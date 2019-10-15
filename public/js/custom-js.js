$(document).ready(function() {
    $.ajaxSetup({
      headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('#stateName').on('change', function (e) {
        e.preventDefault();
        var stateId = $(this).val();
        $('#regionName').html('<option value="">Select city first</option>');
        $.ajax({
            type: "POST",
            url: '/regions/city',
            data: {'state_id' : stateId},
            success: function( res ) {
                console.log(res.cities)
                if(res.cities.length > 0){
                    var option = '<option value="">Select city</option>';
                    res.cities.forEach(function(city){
                      console.log(city)
                      option += '<option value="'+city.id+'">'+city.name+'</option>';
                    })
                    $('#cityName').html(option);
                }else{
                    $('#cityName').html('<option value="">No city found</option>');
                }

                
                
            }
        });
    });
    $('#cityName').on('change', function (e) {
        e.preventDefault();
        var cityId = $(this).val();
        var stateId = $('#stateName').val();
        $.ajax({
            type: "POST",
            url: '/regions/region',
            data: {
                'state_id' : stateId,
                'city_id' : cityId,
               },
            success: function( res ) {
                console.log(res.regions)
                if(res.regions.length > 0){
                    // var option = '<option value="">All city</option>';
                    res.regions.forEach(function(region){
                      console.log(region)
                      option = '<option value="'+region.id+'">'+region.name+'</option>';
                    })
                    $('#regionName').html(option);
                }else{
                    $('#regionName').html('<option value="">No region found</option>');
                }    
            }
        });
    });


});