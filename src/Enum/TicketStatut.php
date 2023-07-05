<?php

namespace App\Enum;

enum TicketStatut: string
{
    public const AFFECTE = 'AFFECTE';
    public const REAFFECTE = 'REAFFECTE';
    public const ATTENTE = 'EN ATTENTE';
}

?>