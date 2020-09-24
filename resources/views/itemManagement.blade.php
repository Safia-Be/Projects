<!DOCTYPE html>
<html lang="en">
<head>
    <title>VQLICK TEST</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/noui/nouislider.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="css/util.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <!--===============================================================================================-->
</head>
<body>

<div class="container-contact100">
    <div class="wrap-contact100">
        <form class="contact100-form items_Form form-s validate-form" method="get" action="{{url('/items/create')}}">
            @csrf
            <span class="contact100-form-title">
					Items Management Page
				</span>
            @if (session('alert'))
                <div class="wrap-input100 alert alert-danger" role="alert">
                    {{ session('alert')}}
                </div>
            @elseif(session('success'))
                <div class="wrap-input100 alert alert-success" role="alert">
                    {{ session('success')}}
                </div>
            @endif
            <div class="row select-row">
                <div class="col-7">
                    <div class="wrap-input100 validate bg1 ">
                        <input class="input100" type="text" name="name" placeholder="Enter Your Name">
                    </div>
                </div>
                <div class="col-2">
                    <button class="contact100-form-btn mt-2">Add
                        <span>
							<i class="fa fa-plus m-l-7 center " aria-hidden="true"></i>
						</span>
                    </button>
                </div>
            </div>
        </form>
        {{--Selection Part--}}
        <div class="row select-row">
            <div class="col rs1-wrap-input100 ">
                <div class="wrap-input100 bg1 ">
                    <select class="input100 p-0 border-0" id="not_selected_items" name="not_selected_items" size="5">
                        @if( $notSelectedItems->count() < 1)
                            <option value="null">No items available</option>
                        @else
                            @foreach( $notSelectedItems as $notSelected)
                                <option value="{{$notSelected->id}}">{{$notSelected->name}}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
            </div>
            <div class="col-sm-2">
                <div class="container-contact100-form-btn">
                    <button class="contact100-form-btn m-b-4" id="makeSelected">
                            <span>
                                <i class="fa fa-long-arrow-right m-l-7" aria-hidden="true"></i>
                            </span>
                    </button>
                    <button class="contact100-form-btn" id="makeNotSelected">
                            <span>
                                <i class="fa fa-long-arrow-left m-l-7" aria-hidden="true"></i>
                            </span>
                    </button>
                </div>
            </div>

            <div class="col">
                <div class="wrap-input100 bg1 ">
                    <span class="label-input100">Selected Items :</span>
                    {{--                <input class="input100" type="text" name="email" placeholder="Enter Your Email ">--}}
                    <select class="input100 p-0 border-0" id="selected_items" name="selected_items" size="5">
                        @if( $selectedItems->count() < 1)
                            <option value="null">No Selected Items</option>
                        @else
                            @foreach( $selectedItems as $selected)
                                <option value="{{$selected->id}}">{{$selected->name}}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>


<!--===============================================================================================-->
<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
<script src="vendor/bootstrap/js/popper.js"></script>
<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
<script src="vendor/select2/select2.min.js"></script>
<script>

    $(".alert").delay(5000).slideUp(200, function () {
        $(this).alert('close');
    });

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': "{{ csrf_token() }}"
        }
    });

    $('#makeSelected').click(function () {
        var itemId = $('#not_selected_items').children("option:selected").val();

        if (itemId) {
            $.ajax({
                type: 'post',
                url: '/items/select',
                data: {
                    itemId: itemId,
                },
                complete: function () {
                    location.reload();
                }
            });
        } else {
            alert("Make sure you select an item")
        }
    });

    $('#makeNotSelected').click(function () {
        var item_Id = $('#selected_items').children("option:selected").val();

        if (item_Id) {
            $.ajax({
                type: 'post',
                url: '/items/unselect',
                data: {
                    itemId: item_Id,
                },
                complete: function () {
                    location.reload();
                }
            });

        } else {
            alert("Make sure you select an item")
        }
    });

</script>

</body>
</html>
