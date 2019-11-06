<?php

function checkInput() {
    $status = true;
    $inputfields = array('name' => true, 'vorname'=> true, 'email'=> true);

    if ( !CheckName( getValue('post')->kontakt->name ) ) {
        $inputfields['name'] = false;
        $status = false;
    }

    if ( !CheckName( getValue('post')->kontakt->vorname ) ) {
        $inputfields['vorname'] = false;
        $status = false;
    }

    if ( !CheckEmail( getValue('post')->kontakt->email ) ) {
        $inputfields['email'] = false;
        $status = false;
    }

    if ( $status ) return formatMessage();
    else return formatMessage(false, 'Input validation failed', $inputfields);
}

function kontakt() {
    switch ( getValue('post')->func ) {
        case 'speichern':
            $status = checkInput();
            if ( $status['status'] ) {
                db_insert_kontakt(getValue('post')->kontakt);
            }
            return $status;
    }
}

function liste() {
    switch ( getValue('post')->func ) {
        case 'lesen':
            $data = db_select_kontakt();
            return formatMessage(true, 'success', $data);
        case 'loeschen': 
            db_delete_kontakt( getValue('post')->kid );
            break;
        
    }
}

?>