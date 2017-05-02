<?php

return [

	/*
	|--------------------------------------------------------------------------
	| Validation Language Lines
	|--------------------------------------------------------------------------
	|
	| The following language lines contain the default error messages used by
	| the validator class. Some of these rules have multiple versions such
	| as the size rules. Feel free to tweak each of these messages here.
	|
	*/

	"accepted"             => "Поле :attribute повинне бути підтвердженим.",
	"active_url"           => "Поле :attribute не є URLом.",
	"after"                => "Поле :attribute повинне бути датою після :date.",
	"alpha"                => "Поле :attribute повинне містити лише букви.",
	"alpha_dash"           => "Поле :attribute повинне містити лише букви, цифри та нижні підкреслення.",
	"alpha_num"            => "Поле :attribute повинне містити лише букви та цифри.",
	"array"                => "Поле :attribute повинне бути масивом.",
	"before"               => "Поле :attribute повинне бути датою перед :date.",
	"between"              => [
		"numeric" => "Поле :attribute повинне бути між :min та :max.",
		"file"    => "Поле :attribute повинне бути між :min та :max кілобайт.",
		"string"  => "Поле :attribute повинне бути між :min та :max символів.",
		"array"   => "Поле :attribute повинне містити від :min до :max елементів.",
	],
	"boolean"              => "Поле :attribute повинне бути true або false.",
	"confirmed"            => "Поле :attribute не співпадає з повтором.",
	"date"                 => "Поле :attribute не є валідною датою.",
	"date_format"          => "Поле :attribute не підпадає під формат дати :format.",
	"different"            => "Поле :attribute і :other повинні бути різними.",
	"digits"               => "Поле :attribute повинне бути :digits цифр.",
	"digits_between"       => "Поле :attribute повинне бути між :min та :max цифр.",
	"email"                => "Поле :attribute повинне бути валідною email адресою.",
	"filled"               => "Поле :attribute обов'язкове для заповнення.",
	"exists"               => "Вибраний(ні) :attribute не є валідними.",
	"image"                => "Поле :attribute повинне бути зображенням.",
	"in"                   => "Поле :attribute не є валідним.",
	"integer"              => "Поле :attribute повинне бути цілочисельного типу.",
	"ip"                   => "Поле :attribute повинне бути валідною IP адресою.",
	"max"                  => [
		"numeric" => "Поле :attribute повинне бути не більше ніж :max.",
		"file"    => "Поле :attribute повинне бути не більше ніж :max кілобайт.",
		"string"  => "Поле :attribute повинне бути не більше ніж :max символів.",
		"array"   => "Поле :attribute не може містити більше :max елементів.",
	],
	"mimes"                => "Поле :attribute повинне бути наступних типів: :values.",
	"min"                  => [
		"numeric" => "Поле :attribute повинне бути не менше :min.",
		"file"    => "Поле :attribute повинне бути не менше :min кілобайт.",
		"string"  => "Поле :attribute повинне бути не менше :min символів.",
		"array"   => "Поле :attribute повинне містити не менше :min елементів.",
	],
	"not_in"               => "Поле :attribute не є валідним.",
	"numeric"              => "Поле :attribute повинне бути числового типу.",
	"regex"                => "Поле :attribute не підходить під заданий формат.",
	"required"             => "Поле :attribute обов'язкове для заповнення.",
	"required_if"          => "Поле :attribute обов'язкове для заповнення коли :other має значення :value.",
	"required_with"        => "Поле :attribute обов'язкове для заповнення коли :values присутні.",
	"required_with_all"    => "Поле :attribute обов'язкове для заповнення коли :values присутні.",
	"required_without"     => "Поле :attribute обов'язкове для заповнення коли :values відсутні.",
	"required_without_all" => "Поле :attribute обов'язкове для заповнення коли жодне з :values присутні.",
	"same"                 => "Поле :attribute і :other повинні співпадати.",
	"size"                 => [
		"numeric" => "Поле :attribute повинне бути :size.",
		"file"    => "Поле :attribute повинне бути :size кілобайт.",
		"string"  => "Поле :attribute повинне бути :size символів.",
		"array"   => "Поле :attribute must contain :size елементів.",
	],
	"unique"               => "Поле :attribute повинне бути унікальним.",
	"url"                  => "Поле :attribute повинне бути посиланням.",
	"timezone"             => "Поле :attribute повинне бути валідною часовою зоною.",

	/*
	|--------------------------------------------------------------------------
	| Custom Validation Language Lines
	|--------------------------------------------------------------------------
	|
	| Here you may specify custom validation messages for attributes using the
	| convention "attribute.rule" to name the lines. This makes it quick to
	| specify a specific custom language line for a given attribute rule.
	|
	*/

	'custom' => [
		'attribute-name' => [
			'rule-name' => 'custom-message',
		],
	],

	/*
	|--------------------------------------------------------------------------
	| Custom Validation Attributes
	|--------------------------------------------------------------------------
	|
	| The following language lines are used to swap attribute place-holders
	| with something more reader friendly such as E-Mail Address instead
	| of "email". This simply helps us make messages a little cleaner.
	|
	*/

	'attributes' => [],

];
