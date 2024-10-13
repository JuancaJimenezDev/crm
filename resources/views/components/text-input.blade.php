@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-gray dark:border-gray dark:bg-white dark:text-gray focus:border-green dark:focus:border-green focus:ring-green dark:focus:ring-green rounded-md shadow-sm']) !!}>
