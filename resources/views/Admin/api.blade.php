@extends('layouts.layout')
@section('content')
<main id="main-container">
    <!-- Page Content -->
    <div class="content">
        <h2 class="content-heading">Danh sách API</h2>
        <div class="block">
            <div class="block-content block-content-full">
                <div class="table-responsive">
                    <table class="table table-bordered mb-0">
                        <tbody>
                            <tr class="table-active">
                                <th colspan="2">Đăng nhập</th>
                            </tr>
                            <tr>
                                <td style="width: 25%;">
                                    URL
                                </td>
                                <td style="width: 75%;">
                                    <code>/api/login</code>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 25%;">
                                    Method
                                </td>
                                <td style="width: 75%;">
                                    <code>Post</code>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 25%;">
                                    Body
                                </td>
                                <td style="width: 75%;">
                                    <code>
                                            {
                                                <br>phone:0937751275,
                                                <br>password:111111,<br>
                                            }
                                    </code>
                                </td>
                            </tr>
                            {{-- Đăng ký
                            <tr class="table-active">
                                <th colspan="2">Đăng ký</th>
                            </tr>
                            <tr>
                                <td style="width: 25%;">
                                    URL
                                </td>
                                <td style="width: 75%;">
                                    <code>/api/register</code>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 25%;">
                                    Method
                                </td>
                                <td style="width: 75%;">
                                    <code>Post</code>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 25%;">
                                    Body
                                </td>
                                <td style="width: 75%;">
                                    <code>
                                            {
                                                <br>username:a@gmail.com,
                                                <br>password:111111,
                                                <br>c_password:111111,
                                                <br>name:Nguyễn văn a,
                                                <br>branch_id:1<br>
                                            }
                                    </code>
                                </td>
                            </tr> --}}

                            {{-- Check in --}}
                            <tr class="table-active">
                                <th colspan="2">Check in</th>
                            </tr>
                            <tr>
                                <td style="width: 25%;">
                                    URL
                                </td>
                                <td style="width: 75%;">
                                    <code>/api/check-in</code>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 25%;">
                                    Method
                                </td>
                                <td style="width: 75%;">
                                    <code>Post</code>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 25%;">
                                    Body
                                </td>
                                <td style="width: 75%;">
                                    <code>
                                    <pre>
{
    "school_id": "4",
    "address" : "sssssss",
    "lat": "10.82007188812566",
    "lng": "106.69086376803844"
}
                                    </code>

                                    </pre>
                                </td>
                            </tr>
                            {{-- check out --}}
                            {{-- Check in --}}
                            <tr class="table-active">
                                <th colspan="2">Check out</th>
                            </tr>
                            <tr>
                                <td style="width: 25%;">
                                    URL
                                </td>
                                <td style="width: 75%;">
                                    <code>/api/check-out</code>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 25%;">
                                    Method
                                </td>
                                <td style="width: 75%;">
                                    <code>Post</code>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 25%;">
                                    Body
                                </td>
                                <td style="width: 75%;">
                                    <code>
                                    <pre>
{
    "school_id": "2",
    "address" : "tettsss",
    "lat": "10.82007188812566",
    "lng": "106.69086376803844"
    "signature": "Chữ Kí"
}
                                    </code>

                                    </pre>
                                </td>
                            </tr>

                            {{-- Get list check in --}}
                            <tr class="table-active">
                                <th colspan="2">Get list check in</th>
                            </tr>
                            <tr>
                                <td style="width: 25%;">
                                    URL
                                </td>
                                <td style="width: 75%;">
                                    <code>/api/get-check-in</code>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 25%;">
                                    Method
                                </td>
                                <td style="width: 75%;">
                                    <code>GET</code>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 25%;">
                                    Body
                                </td>
                                <td style="width: 75%;">
                                    <code>
                                    <pre>
                                    </code>

                                    </pre>
                                </td>
                            </tr>
                             {{-- Get Profile --}}
                             <tr class="table-active">
                                <th colspan="2">Get Profile</th>
                            </tr>
                            <tr>
                                <td style="width: 25%;">
                                    URL
                                </td>
                                <td style="width: 75%;">
                                    <code>/api/profile</code>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 25%;">
                                    Method
                                </td>
                                <td style="width: 75%;">
                                    <code>GET</code>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 25%;">
                                    Body
                                </td>
                                <td style="width: 75%;">
                                    <code>
                                    <pre>
                                    </code>

                                    </pre>
                                </td>
                            </tr>
                            {{--  Get list School  --}}
                            <tr class="table-active">
                                <th colspan="2">Get List School</th>
                            </tr>
                            <tr>
                                <td style="width: 25%;">
                                    URL
                                </td>
                                <td style="width: 75%;">
                                    <code>/api/get-list-school</code>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 25%;">
                                    Method
                                </td>
                                <td style="width: 75%;">
                                    <code>GET</code>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 25%;">
                                    Body
                                </td>
                                <td style="width: 75%;">
                                    <code>
                                    <pre>
                                    </code>

                                    </pre>
                                </td>
                            </tr>

                            {{--  Get cout time  --}}
                            <tr class="table-active">
                                <th colspan="2">Chang Password</th>
                            </tr>
                            <tr>
                                <td style="width: 25%;">
                                    URL
                                </td>
                                <td style="width: 75%;">
                                    <code>/api/chang-password</code>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 25%;">
                                    Method
                                </td>
                                <td style="width: 75%;">
                                    <code>Post</code>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 25%;">
                                    Body
                                </td>
                                <td style="width: 75%;">
                                    <code>
                                    <pre>
                                    </code>
{
    "old_password" : "MTIzNDU21",
    "password" : "MTIzNDU2",
    "password_confirmation": "MTIzNDU2"
}
                                    </pre>
                                </td>
                            </tr>
                               {{--  Get cout time  --}}
                               <tr class="table-active"
                                <th colspan="2">Cout timekeeping</th>
                            </tr>
                            <tr>
                                <td style="width: 25%;">
                                    URL
                                </td>
                                <td style="width: 75%;">
                                    <code>/api/cout-timekeeping</code>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 25%;">
                                    Method
                                </td>
                                <td style="width: 75%;">
                                    <code>GET</code>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 25%;">
                                    Body
                                </td>
                                <td style="width: 75%;">
                                    <code>
                                    <pre>
                                    </code>

                                    </pre>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- END Layout API -->
    </div>
    <!-- END Page Content -->
</main>
@endsection

