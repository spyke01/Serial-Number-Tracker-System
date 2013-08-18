<?php
/***************************************************************************
 *                               it.php
 *                            -------------------
 *   begin                : Saturday, Sept 24, 2005
 *   copyright            : (C) 2005 Paden Clayton - Fast Track Sites
 *   email                : sales@fasttacksites.com
 *
 *
 ***************************************************************************/

/***************************************************************************
Redistribution and use in source and binary forms, with or without
modification, are permitted provided that the following conditions are met:
    * Redistributions of source code must retain the above copyright
      notice, this list of conditions and the following disclaimer.
    * Redistributions in binary form must reproduce the above copyright
      notice, this list of conditions and the following disclaimer in the
      documentation and/or other materials provided with the distribution.
    * Neither the name of the <organization> nor the
      names of its contributors may be used to endorse or promote products
      derived from this software without specific prior written permission.

THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND
ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED
WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE
DISCLAIMED. IN NO EVENT SHALL <COPYRIGHT HOLDER> BE LIABLE FOR ANY
DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES
(INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND
ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
(INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS
SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 ***************************************************************************/

//============================
// Text values in Italian
//============================
/*Globally Used Values*/
	/*~~Navigation~~*/
		$T_HOME = "Domestico";
		$T_LOGIN = "Inizio attività";
		$T_LOGOUT = "Termine attività";
		$T_ADMIN_PANEL = "Pannello Di Admin";
		$T_USER_ADMINISTRATION = "Gestione Dell'Utente";
		$T_CONFIGURATION = "Configurazione";
		$T_THEMES = "Temi";
	
	/*~~General~~*/
		$T_PLEASE = "Per favore";
		$T_ALL = "Tutti";
		$T_HOMEPAGE_MSG = "Il benvenuto alla pista veloce situa il sistema dell'inseguitore di numero di serie. Usando questo sistema, potete tenersi al corrente dei numeri di serie dei calcolatori, dei programmi, delle attrezzature, o di tutti i altri prodotti di che dovete avere una lista.";
		$T_THANKS_LOGIN = "Grazie per logging dentro, voi può ora accedere al";
		$T_PLEASE_LOGIN = "Prima di potere usare il sistema, dovete in primo luogo";
		$T_LOWER_LOGIN = "inizio attività";
		$T_LOWER_ADMIN_PANEL = "pannello di admin";
		$T_NOW = "ora";
		$T_LANGUAGE_CHANGED = "La vostra lingua è stata cambiata e state riorientandi al homepage.";
		$T_PRINTER_FRIENDLY_VERSION = "Versione Amichevole Dello Stampatore";
	
	/*~~Logins, Joining, and User Administration~~*/
		$T_USERNAME = "Username";
		$T_PASSWORD = "Parola d'accesso";
		$T_CONFIRM_PASSWORD = "Confermi La Parola d'accesso";
		$T_NEW_PASSWORD = "Nuova Parola d'accesso";
		$T_CONFIRM_NEW_PASSWORD = "Confermi Nuova Parola d'accesso";
		$T_EMAIL_ADDRESS = "Email Address";
		$T_USER_LEVEL = "Livello Di Accesso";
		$T_ADD_USER = "Aggiunga un nuovo utente";
		$T_EDIT_USER = "Pubblichi un utente corrente";
		$T_DELETE_USER = "Cancelli un utente corrente";
		
	/*~~Errors~~*/
		$T_NOT_AUTHORIZED = "Non siete autorizzati ad osservare questa sezione.";
		$T_NO_SERIALS_FOUND = "Nessun numero di serie è stato trovato. Generi prego uno e provi ancora.";
		$T_REQUIRED_USERNAME = "Il username voluto è un campo richiesto. Prego prova ancora.";
		$T_TAKEN_USERNAME = "Il username che avete selezionato già è stato usato da un altro membro nella nostra base di dati. Scelga prego un username differente!";
		$T_CREATION_ERROR = "Ha stato un errore che genera il vostro cliente. Mettasi in contatto con prego il webmaster.";
		$T_COULD_NOT_LOGIN = "Non potreste essere entrati! O il username e la parola d'accesso non abbinano o non avete convalidato il vostro insieme dei membri!";
		$T_TRY_AGAIN = "Prego prova ancora!";
		$T_ADD_USER_ERROR = "Ci era un errore mentre generava il vostro nuovo utente. State riorientandi alla pagina principale.";
		$T_EDIT_USER_ERROR = "Ci era un errore mentre accedeva ai particolari che dell'utente state provando ad aggiornare. State riorientandi alla pagina principale.";
		$T_ADD_SERIAL_ERROR = "Ci era un problema mentre aggiungeva le vostre informazioni di serie. State riorientandi alla pagina principale.";
		$T_EDIT_SERIAL_ERROR = "Ci era un problema mentre aggiornava le vostre informazioni di serie. State riorientandi alla pagina principale.";
		$T_INSERTION_ERROR = "ERRORE: La domanda di SQL da inserire è venuto a mancare";
		$T_DELETION_ERROR = "ERRORE: La domanda di SQL da cancellare è venuto a mancare";
		$T_UPDATE_ERROR = "ERRORE: La domanda di SQL all'aggiornamento è venuto a mancare";

/*Values for admin.php*/
	$T_DISPLAY = "Display";
	$T_SERIAL = "Pubblicazioni periodiche";
	$T_SERIALS = "Pubblicazioni periodiche";
	$T_STARTING_AT ="file che iniziano alla fila";
	$T_UPDATE = "AGGIORNAMENTO";
	$T_SEARCH = "Pubblicazioni periodiche Di Ricerca";
	$T_SERIAL_NUMBER = "Numero di serie";
	$T_TYPE = "Tipo";
	$T_LOCATION = "Posizione";
	$T_OWNER = "Proprietario";
	$T_DATE = "Data Dell'Acquisto";
	$T_TECH = "Tecnico";
	$T_SEARCH_WARNING = "Immetta l'tutto o una parte di seguenti campi per cercare la base di dati.";
	$T_SEARCH = "Ricerca";
	$T_ADD_SERIAL = "Aggiunga la pubblicazione periodica";
	$T_EDIT_SERIAL = "Pubblichi la pubblicazione periodica";
	$T_UPDATE_SERIAL = "Pubblicazione periodica Dell'Aggiornamento";
	$T_ADD_SERIAL_SUCCESS = "Le vostre informazioni di serie sono state aggiunte con successo. State riorientandi alla pagina principale.";
	$T_EDIT_SERIAL_SUCCESS = "Le vostre informazioni di serie sono state aggiornate con successo. State riorientandi alla pagina principale.";

	/*Values for settings.php*/
	$T_SNTS_SETTINGS = "Sistema Settings Del Fast Track Sites Serial Number Tracker";
	$T_ACTIVE = "Attivo";
	$T_INACTIVE_MSG = "Messaggio Inattivo";
	$T_COOKIE_NAME = "Nome Del Biscotto";
	$T_SNTS_DEFAULT_LANGUAGE = "Lingua Di Difetto";
	$T_ADMIN_EMAIL = "Email Di Admin";
	$T_SETTINGS_UPDATE_BUTTON = "Regolazioni Dell'Aggiornamento";
	$T_CHANGE_LANGUAGE = "Cambi La Lingua";
	
	$T_ADD_CAT_SUCCESS = "La vostra nuova categoria è stata aggiunta e state riorientandi alla pagina principale.";
	$T_EDIT_CAT_SUCCESS = "La vostra categoria è stata aggiornata e state riorientandi alla pagina principale.";
	$T_ADD_CAT = "Generi La Categoria";
	$T_EDIT_CAT = "Pubblichi La Categoria";
	$T_DELETE_CAT = "Categoria Di Cancellazione";
	$T_ADD_CAT_BUTTON = "Generi La Categoria";
	$T_EDIT_CAT_BUTTON = "Cambilo!";
	$T_CATEGORY = "Categorie";
	$T_CATEGORIES = "Categorie";
	$T_CATEGORY_NAME = "Nome Di Categoria";
	$T_CHANGE_LANGUAGE = "Cambi La Lingua";
	
/*Values for footer.php*/
	$T_POWERED_BY = "Alimentato Vicino";
	$T_FTSSNTS = "Fast Track Sites Serial Number Tracker System";
	$T_COPYRIGHT = "Copyright";
	$T_FTS = "Fast Track Sites";
	
/*Values for header.php*/
	$T_WELCOME_BACK = "Benvenuto Indietro";
	$T_WELCOME_GUEST = "Ospite Benvenuto";
	
/*Values for login.php*/
	$T_NOW_LOGGED_IN_MSG = "Ora siete entrati As";
	$T_AND_BEING_REDIRECTED_MAIN = "e stanno riorientandi alla pagina principale.";
	$T_STAY_LOGGED_IN = "Soggiorno entrato";
	
/*Values for users.php*/
	$T_ADD_USER_SUCCESS = "Il vostro nuovo utente è stato aggiunto e state riorientandi alla pagina principale.";
	$T_EDIT_USER_SUCCESS = "Particolari del vostro utente sono stati aggiornati e state riorientandi alla pagina principale.";
	$T_ADD_USER_BUTTON = "Generi L'Utente";
	$T_EDIT_USER_BUTTON = "Cambilo!";
	$T_CURRENT_USERS = "Utenti Correnti";
	
/*Values for themes.php*/
	$T_CHANGE_THEME_SUCCESS = "Il vostro tema è stato cambiato con successo.";
	$T_CHANGE_THEME_ERROR = "là era un errore mentre tentava di cambiare il vostro tema.";
	$T_FIRST_NAME = "Primo Name";
	$T_LAST_NAME = "Ultimo Name";
	$T_PREVIEW = "Previsione";
	$T_AUTHOR = "Autore";
	$T_THEMES_UPDATE_BUTTON = "Cambiamento Esso!";


?>