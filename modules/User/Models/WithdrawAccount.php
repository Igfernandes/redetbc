<?php

namespace Modules\User\Models;

use App\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Booking\Models\Bookable;
use Modules\User\Models\User;

/**
 * Class WithdrawAccount
 *
 * @property int $id
 * @property int $user_id
 * @property string|null $bank_name
 * @property string|null $account_name
 * @property string $owner_name
 * @property string|null $owner_birthdate
 * @property string $cpf_cnpj
 * @property string|null $agency
 * @property string|null $account
 * @property string|null $account_digit
 * @property string $bank_account_type
 * @property string|null $ispb
 * @property string $operation_type
 * @property string|null $pix_address_key
 * @property string|null $pix_address_key_type
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class WithdrawAccount extends Bookable
{
    protected $table = 'core_withdraw_accounts';

    protected $fillable = [
        'user_id',
        'bank_name',
        'account_name',
        'owner_name',
        'owner_birthdate',
        'document',
        'agency',
        'account',
        'account_digit',
        'bank_account_type',
        'ispb',
        'operation_type',
        'pix_address_key',
        'pix_address_key_type',
    ];
    /**
     * 🔄 Desabilita comportamento de auditoria do BaseModel
     * para impedir qualquer insert/update automático de create_user/update_user
     */
    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            unset($model->create_user, $model->update_user);
        });

        static::updating(function ($model) {
            unset($model->create_user, $model->update_user);
        });
    }


    /**
     * 🔗 Relação: conta pertence a um usuário.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * 🧾 Cria ou atualiza uma conta de saque para o usuário logado.
     */
    public static function storeOrUpdate(array $data)
    {
        $user = auth()->user();

        return self::updateOrCreate(
            ['user_id' => $user->id],
            $data
        );
    }

    /**
     * 🔍 Retorna o nome mascarado do banco (exemplo: "Bradesco (****1234)").
     */
    public function getDisplayNameAttribute()
    {
        $lastDigits = $this->account_digit ? substr($this->account_digit, -2) : '??';
        return "{$this->bank_name} (****{$lastDigits})";
    }
}
