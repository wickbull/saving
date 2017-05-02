<li role="presentation" class="js-container-loader" data-container=".js-lecturers-materials-container" data-url="{{ action('\Packages\PackageLecturersController@getLecturersByUser', $user) }}">
	<a href="#lecturers" aria-controls="lecturers" role="tab" data-toggle="tab">{{ _('Lecturers') }}</a>
</li>
