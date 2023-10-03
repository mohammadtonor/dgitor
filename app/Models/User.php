<?php

namespace App\Models;

use App\Models\Category\Category\Category;
use App\Models\Category\PreProduct\PreProduct;
use App\Models\Exchange\Exchange\Exchange\Exchange;
use App\Models\Financial\Bon\UserBon;
use App\Models\Financial\Purchase\Order\Order;
use App\Models\Financial\TotalFin\TotalFin;
use App\Models\Financial\Wallet\UserWallet;
use App\Models\Location\City;
use App\Models\Location\Country;
use App\Models\Location\Ostan;
use App\Models\Organization\OrgPosition\OrgPosition;
use App\Models\Organization\OrgPosition\PositionUserArchive\PositionUserArchive;
use App\Models\Organization\PaySlip\PaySlip;
use App\Models\PeriodicService\PeriodicService\PeriodicService;
use App\Models\Permission\Permission\Permission;
use App\Models\Permission\Role\Role;
use App\Models\Product\AttrValue\ProductAttrValue;
use App\Models\Product\Product\Product;
use App\Models\User\Address\UserAddress;
use App\Models\User\BankAccount\UserBankAccount;
use App\Models\User\File\UserFile;
use App\Models\User\Madarek\Madarek;
use App\Models\User\Phone\UserPhone;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use SoftDeletes;
    protected $table = "users";
    protected $guarded = [];
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class, "role_user", "user_id", "role_id");
    }

    public function uploader_files()
    {
        return $this->hasMany(UserFile::class, "user_id");
    }

    public function owner_files()
    {
        return $this->hasMany(UserFile::class, "user_id");
    }

    public function vippermissions()
    {
        return $this->belongsToMany(Permission::class, "vip_permission", "user_id", "permission_id");
    }

    public function blockpermissions()
    {
        return $this->belongsToMany(Permission::class, "block_permission", "user_id", "permission_id");
    }

    public function country()
    {
        return $this->belongsTo(Country::class, "country_id");
    }

    public function ostan()
    {
        return $this->belongsTo(Ostan::class, "ostan_id");
    }
    public function city()
    {
        return $this->belongsTo(City::class, "city_id");
    }

    public function addresses()
    {
        return $this->hasMany(UserAddress::class, "user_id");
    }

    public function phones()
    {
        return $this->hasMany(UserPhone::class, "user_id");
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, "category_user", "user_id", "category_id");
    }

    public function exchanges1()
    {
        return $this->hasMany(Exchange::class, "register_user1_id");
    }

    public function exchanges2()
    {
        return $this->hasMany(Exchange::class, "register_user2_id");
    }

    public function org_positions()
    {
        return $this->belongsToMany(OrgPosition::class, "position_user", "user_id", "position_id");
    }

    public function position_user_archives()
    {
        return $this->hasMany(PositionUserArchive::class, "user_id");
    }

    public function pay_slips()
    {
        return $this->hasMany(PaySlip::class, "user_id");
    }

    public function orders()
    {
        return $this->hasMany(Order::class, "user_id");
    }

    public function periodic_services()
    {
        return $this->hasMany(PeriodicService::class, "user_id");
    }

    public function wallets()
    {
        return $this->hasMany(UserWallet::class, "user_id");
    }

    public function bons()
    {
        return $this->hasMany(UserBon::class, "user_id");
    }

    public function total_fins()
    {
        return $this->hasMany(TotalFin::class, "user_id");
    }

    public function product_attr_values()
    {
        return $this->hasMany(ProductAttrValue::class, "register_user_id", "id");
    }

    public function products()
    {
        return $this->hasMany(Product::class, "register_user_id", "id");
    }

    public function pre_products()
    {
        return $this->hasMany(PreProduct::class, "register_user_id");
    }

    public function bank_accounts()
    {
        return $this->hasMany(UserBankAccount::class, "user_id");
    }

    public function customers()
    {
        return $this->belongsToMany(User::class, "customer_karshenas", "karshenas_user_id", "customer_user_id");
    }

    public function karshenases()
    {
        return $this->belongsToMany(User::class, "customer_karshenas", "customer_user_id", "karshenas_user_id");
    }

    public function user_madareks()
    {
        return $this->hasMany(Madarek::class, "user_id");
    }

    public function uploader_madareks()
    {
        return $this->hasMany(Madarek::class, "uploader_user_id");
    }
}
