@include('Website/Assets/header')

<!-- Content Code Start -->

    <article>
        <div class="container">
            <div class="box_editprofile_content" id="ClientEditProfile">
                
            </div> 
        </div>
    </article>

<!-- Content Code End -->

@include('Website/Assets/footer')

<script type="text/javascript">
    
$.ajax({
    url: "{{url('api/editUserProfile')}}",
    type: "POST",
    dataType: 'json',
    
    success:function(response){

        if (response.status == true)
        {
            $("#ClientEditProfile").append(response.editProfile);
        }
        else
        {
            toastr.error(response.message);
        }
    },
    error:function(error){
        toastr.error(error.message);
    },
});

</script>