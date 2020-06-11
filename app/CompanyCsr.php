<?php


namespace App;


use Illuminate\Database\Eloquent\Model;


class CompanyCsr extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'company_csr';
    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'CIN', 'YearOfFiling', 'csrappli', 'csrpolicy', 'csr_committee',
         'turnover', 'Networth', 'AvgNetPro', 'CSRExpPres', 'CSR_Spent', 
         'locarea_spent', 'csr_devsect', 'csr_project', 'csr_state', 
         'project_amtoverlay', 'project_amountspent', 'administ_overhead',
          'unspent_amt', 'detailsia', 'modeofamtspent', 'unspent_reason', 
          'compname', 'CompCat', 'CompSubCat', 'listing', 'compclass', 
          'compstate', 'compsector', 'compROC', 'csr_district'
    ];
}