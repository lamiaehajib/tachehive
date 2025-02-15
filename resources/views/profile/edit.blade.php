<x-app-layout>
    <style>
        /* Global styles */

* {
  box-sizing: border-box;
  margin: 0;
  padding: 0;
}

body {
  font-family: Arial, sans-serif;
  line-height: 1.6;
  color: #333;
  background-color: #f9f9f9;
  margin-left: 250px;
}
/* Section styles */

.space-y-6 {
  padding: 2rem;
  background-color: #fff;
  border: 1px solid #ddd;
  border-radius: 0.5rem;
 
}

/* Header styles */

header {
  margin-bottom: 1rem;
}

header h2 {
  font-size: 1.5rem;
  font-weight: bold;
  color: #333;
  margin-bottom: 0.5rem;
}

header p {
  font-size: 0.875rem;
  color: #666;
  margin-bottom: 1rem;
}

/* Button styles */

.danger-button {
  background-color: #e3342f;
  color: #fff;
  border: none;
  padding: 0.5rem 1rem;
  font-size: 0.875rem;
  font-weight: bold;
  border-radius: 0.25rem;
  cursor: pointer;
}

.danger-button:hover {
  background-color: #c02c1d;
}

.secondary-button {
  background-color: #666;
  color: #fff;
  border: none;
  padding: 0.5rem 1rem;
  font-size: 0.875rem;
  font-weight: bold;
  border-radius: 0.25rem;
  cursor: pointer;
}

.secondary-button:hover {
  background-color: #444;
}

/* Modal styles */

.modal {
  position: fixed;
  top: 0;
  right: 0;
  bottom: 0;
  left: 0;
  background-color: rgba(0, 0, 0, 0.5);
  display: flex;
  justify-content: center;
  align-items: center;
  visibility: hidden;
  opacity: 0;
  transition: visibility 0.5s, opacity 0.5s;
}

.modal.show {
  visibility: visible;
  opacity: 1;
}

.modal form {
  background-color: #fff;
  padding: 2rem;
  border-radius: 0.5rem;
  width: 400px;
  margin: 0 auto;
}

.modal h2 {
  font-size: 1.5rem;
  font-weight: bold;
  color: #333;
  margin-bottom: 0.5rem;
}

.modal p {
  font-size: 0.875rem;
  color: #666;
  margin-bottom: 1rem;
}

.modal .mt-6 {
  margin-top: 1.5rem;
}

.modal .flex {
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.modal .ml-3 {
  margin-left: 0.75rem;
}

/* Input styles */

.input-label {
  font-size: 0.875rem;
  color: #666;
  margin-bottom: 0.5rem;
}

.text-input {
  padding: 0.5rem;
  font-size: 0.875rem;
  border: 1px solid #ccc;
  border-radius: 0.25rem;
  width: 100%;
}

.text-input:focus {
  border-color: #aaa;

}

.input-error {
  font-size: 0.75rem;
  color: #e3342f;
  margin-top: 0.5rem;
}
    </style>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div >
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div >
                <div >
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div >
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>
            @can("profile-delete")
            <div >
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
            @endcan
        </div>
    </div>
</x-app-layout>
