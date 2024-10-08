<?php

declare(strict_types=1);

return [
    'accepted' => ':attribute deve essere accettato.',
    'active_url' => ':attribute non è un URL valido.',
    'after' => ':attribute deve essere una data successiva a :date.',
    'after_or_equal' => 'The :attribute must be a date after or equal to :date.',
    'alpha' => ':attribute può contenere solo lettere.',
    'alpha_dash' => ':attribute può contenere solo lettere, numeri e trattini.',
    'alpha_num' => ':attribute può contenere solo lettere e numeri.',
    'array' => ':attribute deve essere un array.',
    'before' => ':attribute deve essere una data precedente al :date.',
    'before_or_equal' => 'The :attribute must be a date before or equal to :date.',
    'between' => [
        'numeric' => ':attribute deve avere un valore tra :min e :max.',
        'file' => ':attribute deve essere tra :min e :max kilobytes.',
        'string' => ':attribute deve avere tra :min e :max caratteri.',
        'array' => ':attribute deve contenere tra :min e :max elementi.',
    ],
    'boolean' => ':attribute può essere solo vero o falso.',
    'confirmed' => 'La conferma di :attribute non corrisponde.',
    'date' => ':attribute non è una data valida.',
    'date_format' => ':attribute non corrisponde al formato :format.',
    'different' => ':attribute e :other devono essere diversi.',
    'digits' => ':attribute deve avere :digits cifre.',
    'digits_between' => ':attribute deve avere tra :min e :max cifre.',
    'dimensions' => 'The :attribute has invalid image dimensions.',
    'distinct' => 'The :attribute field has a duplicate value.',
    'email' => ':attribute deve essere un indirizzo email valido.',
    'exists' => 'La selezione per :attribute non è valida.',
    'file' => 'The :attribute must be a file.',
    'filled' => ':attribute è obbligatorio.',
    'image' => ":attribute deve essere un'immagine.",
    'in' => 'La selezione per :attribute non è valida.',
    'in_array' => 'The :attribute field does not exist in :other.',
    'integer' => ':attribute deve essere un numero intero.',
    'ip' => ':attribute deve essere un indirizzo IP valido.',
    'json' => ':attribute deve essere una stringa JSON valida.',
    'max' => [
        'numeric' => ':attribute non può essere più grande di :max.',
        'file' => ':attribute non può superare i :max kilobytes.',
        'string' => ':attribute non può superare i :max caratteri.',
        'array' => ':attribute non può avere più di :max elementi.',
    ],
    'mimes' => ':attribute deve essere un file di questo formato: :values.',
    'min' => [
        'numeric' => ':attribute deve essere almeno :min.',
        'file' => ':attribute deve essere di almeno :min kilobytes.',
        'string' => ':attribute deve contenere almeno :min caratteri.',
        'array' => ':attribute deve avere almeno :min elementi.',
    ],
    'not_in' => 'Il valore selezionato per :attribute non è valido.',
    'numeric' => ':attribute deve essere un numero.',
    'password' => [
        'letters' => 'Il campo :attribute deve contenere almeno una lettera.',
        'mixed' => 'Il campo :attribute deve contenere almeno una lettera maiuscola e una minuscola.',
        'numbers' => 'Il campo :attribute deve contenere almeno un numero.',
        'symbols' => 'Il campo :attribute deve contenere almeno un simbolo.',
        'uncompromised' => 'Il :attribute fornito è apparso in una violazione di dati. Scegli un :attribute diverso, per favore.',
    ],
    'present' => 'The :attribute field must be present.',
    'regex' => 'Il formato di :attribute non è valido.',
    'required' => ':attribute è richiesto.',
    'required_if' => ':attribute è richiesto quando :other è :value.',
    'required_unless' => ':attribute è richiesto se :other non è tra :values.',
    'required_with' => ':attribute è richiesto quando :values è presente.',
    'required_with_all' => ':attribute è richiesto quando :values è presente.',
    'required_without' => ':attribute è richiesto quando :values non è presente.',
    'required_without_all' => ':attribute è richiesto quando nessuno tra :values è presente.',
    'same' => ':attribute e :other devono essere identici.',
    'size' => [
        'numeric' => ':attribute deve essere :size.',
        'file' => ':attribute deve essere di :size kilobytes.',
        'string' => ':attribute deve contenere :size caratteri.',
        'array' => ':attribute deve contenere :size elementi.',
    ],
    'string' => ':attribute deve essere una stringa.',
    'timezone' => ':attribute deve essere un fuso orario valido.',
    'unique' => ':attribute è già stato utilizzato.',
    'url' => 'Il formato di :attribute non è valido.',
    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],
    'attributes' => [
        'backend' => [
            'access' => [
                'permissions' => [
                    'associated_roles' => 'Ruoli associati',
                    'dependencies' => 'Dipendenze',
                    'display_name' => 'Nome visualizzato',
                    'group' => 'Gruppo',
                    'group_sort' => 'Ordina gruppo',
                    'groups' => [
                        'name' => 'Nome gruppo',
                    ],
                    'name' => 'Nome',
                    'system' => 'Sistema?',
                ],
                'roles' => [
                    'associated_permissions' => 'Permessi associati',
                    'name' => 'Nome',
                    'sort' => 'Ordina',
                ],
                'users' => [
                    'active' => 'Attivo',
                    'associated_roles' => 'Ruoli associati',
                    'confirmed' => 'Confermato',
                    'email' => 'Indirizzo e-mail',
                    'name' => 'Nome',
                    'other_permissions' => 'Altri permessi',
                    'password' => 'Password',
                    'password_confirmation' => 'Conferma password',
                    'send_confirmation_email' => 'Invia e-mail di conferma',
                ],
            ],
        ],
        'frontend' => [
            'email' => 'Indirizzo e-mail',
            'name' => 'Nome',
            'password' => 'Password',
            'password_confirmation' => 'Conferma password',
            'old_password' => 'Vecchia password',
            'new_password' => 'Nuova password',
            'new_password_confirmation' => 'Conferma nuova password',
        ],
    ],
];
