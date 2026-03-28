<div>
    {{-- Finalidades --}}
    <div>
        <h5 class="mb-0" style="font-size:1rem;color:#033480;">
            <strong>Meus ícones de Afinidades</strong>
        </h5>
        <p style="font-size:.8rem;">
            <strong>Convivência e Regras</strong>
        </p>
    </div>

    <ul class="list-none row mb-4 p-0" style="list-style:none;">
        @foreach(explode(',', $user->purposes ?? "") as $purpose)
        @if(empty($purpose)) @continue @endif
        @php
        $isPurpose= strpos(Auth::user()->purposes, $purpose) !== false;
        $roleId = $user->role_id == 3 ? 3 : 2;
        $purposes = config("icons.$roleId");

        $purposeTargets = array_filter($purposes, function($item) use ($purpose) {
        return $item['label'] === $purpose;
        });
        $purposeTarget = array_shift($purposeTargets);

        @endphp
        <li class="col-4 col-md-6 px-0 p-relative" style="padding: 3px 0;">
            <div class="d-flex py-1 align-items-center shadow bg-white mx-1"
                style="border: 2px solid {{ $isPurpose ? '#ebd07d' : '#c9c9c9' }};border-radius: 11px;">
                <span class="col-4 px-0" style="font-size: 1.5rem;">{!! $purposeTarget['icon'] ?? '' !!}</span>
                <small style="line-height: normal; font-weight: 600;" class="col-md-8 px-0"> {{ $purpose }}</small>
            </div>
            @if($isPurpose)
            <div class="text-white d-inline-block py-0 px-1  text-right"
                style="background-color: #ebd07d; border-radius: 4px; float:right;margin-top: -6px;line-height: normal;">
                <small style="font-size: .7rem; line-height: normal;">Finalidade!</small>
            </div>
            @endif
        </li>
        @endforeach
    </ul>
</div>