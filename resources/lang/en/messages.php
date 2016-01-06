<?php

return [
    //app.blade
    'app-heading' => 'SH League administration',
    //common
    'home' => 'Home',
    'leagues' => 'Leagues',
    'league' => 'League',
    'tournaments' => 'Tournaments',
    'tournament' => 'Tournament',
    'teams' => 'Teams',
    'team' => 'Team',
    'games' => 'Games',
    'game' => 'Game',
    'users' => 'Users',
    'user' => 'User',
    'details' => 'Details',
    'detail' => 'Detail',
    'detail-of-league' => 'Detail of league',
    'detail-of-tournament' => 'Detail of tournament',
    'detail-of-team' => 'Detail of team',
    'detail-of-user' => 'Detail of user',
    'id' => 'Id',
    'logout' => 'Logout',
    'login' => 'Login',
    'register' => 'Register',
    'registration' => 'Registration',
    'password' => 'Password',
    'password2' => 'Retype password',
    'email' => 'E-mail',
    'do-not-have-acc' => 'Do not have account?',
    'actions'=> 'Actions',
    'avatar' => 'Avatar',
    //errors
    'yoda-err-msg' => 'Dark side of the force, I sense. On mistakes below have a look, my young Padawan',
    'no-tournaments' => 'There are no tournaments in this league.',
    'no-teams' => 'There are no teams in this tournament.',
    'no-members' => 'There are no members in this team',
    'less-than-min-teams-1' => ' There are less than minimum number of teams! At least ',
    'less-than-min-teams-2' => 'more teams must join the tournament.',
    'more-than-max-teams' => 'Tournament is full',
    'admin' => 'Permission denied - You are not admin',
    'logged-in' => 'Permission denied - You are not logged in',
    'nickname-not-available' => 'Nickname is not available',
    'nickname-available' => 'Nickname is available',
    'email-not-available' => 'E-mail is not available',
    'email-available' => 'E-mail is available',
    //info
    'tour-in-progress-1' => 'Tournament is still in progress. It will last for another ',
    'days' => 'days',
    'tour-not-yet-started' => 'Tournament has not started yet. Join it!.',
    'tour-ended' => 'Tournament has ended.',
    //home-blade
    'project-desc-head'=>'Description of this project',
    'project-desc-text'=>'SHLeague administration system was created as semester project to subject WA1 - Web appliations. Project is written
                    in PHP framework Laravel. I was learning Laravel during writing
                    this code, so not all features that Laravel provides are included, e.g. Events, which are handled by
                    JavaScript or JQuery instead. Project is completely prepared for translation based on locale, czech
                    does not have translations yet hence it is not supported at this time.',
    // forms
    'new' => 'New',
    'new-tournament' => 'New tournament',
    'new-league' => 'New league',
    'new-team' => 'New team',
    'new-user' => 'New user',
    'edit' => 'Edit',
    'edit-tournament' => 'Edit tournament',
    'edit-league' => 'Edit league',
    'edit-team' => 'Edit team',
    'edit-user' => 'Edit user',
    'name' => 'Name',
    'abbreviation' => 'Abbreviation',
    'description' => 'Description',
    'max-teams' => 'Max. number of teams',
    'min-teams' => 'Min. number of teams',
    'start-date' => 'Start date',
    'end-date' => 'End date',
    'type' => 'Type',
    'birthdate'=> 'Birthday',
    'state' => 'State',
    'city' => 'City',
    'nickname' => 'Nickname',
    'role' => 'Role',
    'captain' => 'Captain',
    'creator' => 'Created by',
    'teams-in' => 'Teams signed in',
    'required-field'=> 'This field is required',
    'optional-field'=> 'This field is optional',
    'tournament-number'=> 'Number of tournaments',
    'members-count'=> 'Members count',
    'tournaments-in-league'=> 'Tournaments in league',
    'save' => 'Save',
    'reset' => 'Reset',
    'goto' => 'Go to',
    //sups - hints
    'league-name-hint' => 'Unique Name of league',
    'league-abbrev-hint' => 'Unique abbreviation of league',
    'league-desc-hint' => 'Short description of league',
    'league-game-hint' => 'League will be associated with this game.',
    'tour-name-hint' => 'Unique Name of tournament',
    'tour-min-teams-hint' => 'Minimum number of teams which can participate.',
    'tour-max-teams-hint' => 'Maximum number of teams which can participate.',
    'tour-start-date-hint' => 'Date, when tournament starts',
    'tour-end-date-hint' => 'Date, when tournament ends',
    'tour-league-hint' => 'Tournament will be associated in this league.',
    'tour-type-hint' => 'Type of tournament, e.g. Single Elimination.',
    'tour-desc-hint' => 'Short description of the tournament ',
    'user-nickname-hint' => 'Nickname of user.',
    'user-email-hint' => 'Valid email address of user. Used for logging in.',
    'user-psswd-hint' => 'Password must be at least 6 characters long.',
    'user-psswd2-hint' => 'Retype password. Of course, passwords must be the same',
    'user-name-hint' => 'Name and Surname of user.',
    'user-city-hint' => 'Current user\'s town or city.',
    'user-state-hint' => 'Current user\'s state.',
    'user-birthdate-hint' => 'Birthday of user. Please use date picker to avoid problems with date format.',
    'user-desc-hint' => 'Short info about user',
    'user-teams' => 'Teams associated with user',
    'team-desc-hint' => 'Short information about team',
    'team-name-hint' => 'Unique name of team',
    'team-abbrev-hint' => 'Unique abbreviation of team',
    'user-role-in-team' => 'User\'s role in team'



];