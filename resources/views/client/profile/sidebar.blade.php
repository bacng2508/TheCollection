<div class="col-3">
    <div class="d-flex">
        <div><img src="{{ asset('storage/' . Auth::user()->avatar) }}"
                alt="" width="50px"></div>
        <div class="ml-3">
            <span>Tài khoản của</span>
            <h4 class="mb-0">{{Auth::user()->name}}</h4>
        </div>
    </div>
    <hr class="my-3">
    <div>
        <ul>
            <li class="profile__sidebar-item {{ Route::current()->getName() === 'profile.edit' ? 'active__profile-sidebar-item' : '' }}">
                <a href="{{route('profile.edit')}}" class="d-block p-3" style="color: #777; font-size: 15px;">
                    <span class="d-inline-block text-right" style="width: 30px;"><i
                            class="fa-solid fa-user mr-3"></i></span>
                    Thông tin tài khoản
                </a>
            </li>
            <li class="profile__sidebar-item {{ Route::current()->getName() === 'profile.change-password' ? 'active__profile-sidebar-item' : '' }}">
                <a href="{{route('profile.change-password')}}" class="d-block p-3" style="color: #777; font-size: 15px;">
                    <span class="d-inline-block text-right" style="width: 30px;"><i class="fa-solid fa-key mr-3"></i>
                    </span>
                    Đổi mật khẩu
                </a>
            </li>
            <li class="profile__sidebar-item {{ Route::current()->getName() === 'profile.my-orders' || Route::current()->getName() === 'profile.order-detail' ? 'active__profile-sidebar-item' : '' }}">
                <a href="{{route('profile.my-orders')}}" class="d-block p-3" style="color: #777; font-size: 15px;">
                    <span class="d-inline-block text-right" style="width: 30px;"><i
                            class="fa-solid fa-boxes-packing mr-3"></i> </span>
                    Quản lý đơn hàng
                </a>
            </li>
            <li class="profile__sidebar-item {{ Route::current()->getName() === 'profile.product-reviews' ? 'active__profile-sidebar-item' : '' }}">
                <a href="{{route('profile.product-reviews')}}" class="d-block p-3" style="color: #777; font-size: 15px;">
                    <span class="d-inline-block text-right" style="width: 30px;"><i
                            class="fa-solid fa-star-half-stroke mr-3"></i> </span>
                    Sản phẩm đã đánh giá
                </a>
            </li>
            <li>
                <form method="POST" action="{{ route('logout') }}" class="mb-0">
                    @csrf
                    <button class="border-0 bg-transparent p-3 d-block w-100 text-left profile__sidebar-item" type="submit" style="color: #777; font-size: 15px;">
                        <i class="fa-solid fa-arrow-right-from-bracket pl-2" style="width: 30px;"></i>
                        Đăng xuất
                    </button>
                </form>
            </li>
        </ul>
    </div>
</div>
