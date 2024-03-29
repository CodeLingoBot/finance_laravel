<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'description', 'date_init', 'date_end', 'debit_date', 'closed'
    ];

    /**
     * Get account of invoice
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function account()
    {
        return $this->belongsTo('App\Account','account_id');
    }

    /**
     * Get transactions of invoice
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function transactions()
    {
        return $this->hasMany('App\Transaction','invoice_id');
    }

    /**
     * Get total of invoice
     *
     * @return double
     */
    public function total(){
        $lastInvoice = Invoice::where('debit_date', '<', $this->debit_date)->orderBy('debit_date', 'desc')->first();
        return $this->transactions()->sum('value') + (isset($lastInvoice) ? $lastInvoice->total() : 0);
    }

    public function encryptedId(){
        return sslEncrypt($this->id);
    }
}