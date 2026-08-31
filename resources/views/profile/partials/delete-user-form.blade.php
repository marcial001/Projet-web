{{-- filepath: resources/views/profile/partials/delete-user-form.blade.php --}}
<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            Supprimer le compte
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            Une fois votre compte supprimé, toutes ses ressources et données seront définitivement effacées. Avant de supprimer votre compte, veuillez télécharger toutes les données ou informations que vous souhaitez conserver.
        </p>
    </header>

    <button
        type="button"
        class="btn btn-danger"
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
    >Supprimer le compte</button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            <h2 class="text-lg font-medium text-gray-900">
                Êtes-vous sûr de vouloir supprimer votre compte ?
            </h2>

            <p class="mt-1 text-sm text-gray-600">
                Une fois votre compte supprimé, toutes ses ressources et données seront définitivement effacées. Veuillez entrer votre mot de passe pour confirmer la suppression définitive de votre compte.
            </p>

            <div class="mt-6">
                <label for="password" class="sr-only">Mot de passe</label>
                <input
                    id="password"
                    name="password"
                    type="password"
                    class="mt-1 block w-3/4 form-control"
                    placeholder="Mot de passe"
                />
                @if($errors->userDeletion->get('password'))
                    <div class="text-danger mt-2">
                        {{ $errors->userDeletion->first('password') }}
                    </div>
                @endif
            </div>

            <div class="mt-6 flex justify-end">
                <button type="button" class="btn btn-secondary me-2" x-on:click="$dispatch('close')">
                    Annuler
                </button>
                <button type="submit" class="btn btn-danger">
                    Supprimer le compte
                </button>
            </div>
        </form>
    </x-modal>
</section>