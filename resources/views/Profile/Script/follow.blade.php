<script src="http://code.jquery.com/jquery-3.3.1.min.js" type="text/javascript"></script>
<script type="text/javascript">

    function changeText(data){
        $("#follow").text(data);
        if(data =="Following"){
            $("#follow").addClass("following");
        }else if(data == "Follow"){
            $("#follow").removeClass("following");
        };
    };

    $(document).ready(function(){
        console.log("is following : ");
        if("{{$isFollowing}}"){
            changeText("Following");
        }else changeText("Follow");
        $("#follow").click(function(){
            console.log("clicked");
            $.ajax({
                url: 'profile/{{$user->id}}/follow',
                type: 'post', // performing a POST request
                data : {
                    "_token": "{{ csrf_token() }}",
                    followerID : "{{Auth::user()->id}}", // will be accessible in $_POST['data1']
                    followTargetID : "{{$user->id}}"
                },
                success: function(data){
                    changeText(data);
                }
            });
            // $.ajax({url: "{{$user->id}}/test", success: function(result){
            //    				$("#follow").text(result);
            // 			}});
        });

        $("#follow").mouseover(function(){
            if($("#follow").text() == "Following"){
                $("#follow").text("Unfollow");
            }
        });
        $("#follow").mouseleave(function(){
            if($("#follow").text()=="Unfollow")
                $("#follow").text("Following");
        });

    });
</script>