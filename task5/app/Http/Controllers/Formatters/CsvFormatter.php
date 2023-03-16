<?php

namespace App\Http\Controllers\Formatters;


use Illuminate\Database\Eloquent\Collection;

class CsvFormatter
{
    public function format(Collection $data): array {
        $header = [['Name', 'Email', 'School']];
        $memberData = [];
        foreach ($data as $member) {
            $memberData[] = [
                "name"  => $member->name,
                "email"  => $member->email,
                "school"  => $member->school["school_name"],
            ];
        }

        return array_merge($header, $memberData);
    }
}
