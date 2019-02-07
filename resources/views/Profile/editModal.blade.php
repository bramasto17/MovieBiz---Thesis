<div id="myModal" class="modal">

    <!-- Modal content -->
    <div class="modal-content">
        <span class="close">&times;</span>

        <form id="modalForm" action="/profile/edit" method="POST"  enctype="multipart/form-data">
            {{csrf_field()}}
            <input type="hidden" name="userId" value="{{$user->id}}">

            <div class="row">
                <div class="col-sm-4">
                    <img id="image" src="https://www.jainsusa.com/images/store/agriculture/not-available.jpg" alt="" height="75px">
                </div>

                <div class="col-sm-6">
                    <label for="profile_pict">Upload Picture
                        <input type="file" class="form-control" id="profilepic" name="profile_pict">
                    </label>

                    <label for="name">User Name
                        <input type="text" class="form-control" name="name" value="{{$user->name}}">
                    </label>

                    <label for="name">Retype/Change Password
                        <input type="password" name="password" class="form-control">
                    </label>
                </div>
            </div>

            <div class="space-30"></div>

            <div align="right">
                <button type="submit" class="bttn-default bttn-half-padding">Save Changes</button>
            </div>
        </form>
    </div>

</div>