<?php

namespace Vanguard\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Vanguard\Patient;

class PatientExport implements FromQuery, WithHeadings, WithMapping
{
    use Exportable;

    public function query()
    {
        return Patient::query()->with(['sex','getProvince','hospital']);
    }

    public function headings(): array
    {
        return [
            '#',
            'លេខកូដ',
            'ឈ្មោះអ្នកជំងឺ',
            'ភេទ',
            'ថ្ងៃខែឆ្នាំកំណើត',
            'លេខទូរស័ព្ទ',
            'ខេត្ត / រាជធានី',
            'មន្ទីរពេទ្យ',
        ];
    }

    public function map($transaction): array
    {
        return [
            $transaction->id,
            $transaction->code,
            $transaction->name,

            $transaction->sex->value ?? '',

            $transaction->dob,
            $transaction->phone,
            $transaction->getProvince->name ?? '',
            $transaction->hospital->value ?? ''
        ];
    }
    public function fields(): array
    {
        return [
            'id',
            'code',
            'name',
            'sex',
            'dob',
            'phone',
            'getProvince',
            'hospital',
        ];
    }
}
