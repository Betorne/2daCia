<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            <livewire:layout.navigation />

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
               @yield('content')

            </main>
        </div>

        @yield('scripts')
       
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const slideover = document.getElementById('emergency-slideover');
                const buttons = document.querySelectorAll('[data-emergency]');
                
                buttons.forEach(btn => {
                    btn.addEventListener('click', () => {
                        const data = JSON.parse(btn.dataset.emergency);

                        document.getElementById('sld-id').textContent = data.id;
                        document.getElementById('sld-address').textContent = data.address ?? '–';
                        document.getElementById('sld-type').textContent = data.type ?? '–';
                        document.getElementById('sld-description').textContent = data.description ?? '–';
                        document.getElementById('sld-priority').textContent = capitalize(data.priority);
                        document.getElementById('sld-status').textContent = capitalize(data.status.replace('_', ' '));
                        document.getElementById('sld-date').textContent = new Date(data.created_at).toLocaleString();
                        document.getElementById('finalize-form').action = `/emergencies/${data.id}/finalize`;

                    });
                });
                 function updateUnitsList(units) {
                    const list = document.getElementById('sld-units');
                    if (units.length === 0) {
                        list.innerHTML = '<li class="text-gray-400 italic">Sin unidades asignadas</li>';
                    } else {
                        list.innerHTML = units.map(u => `
                            <li class="flex items-center gap-2">
                                <span class="text-blue-600 font-medium">${u.code}</span>
                                <span class="text-gray-500">– ${u.type}</span>
                            </li>
                        `).join('');
                    }
                }
                function capitalize(str) {
                    return str.charAt(0).toUpperCase() + str.slice(1);
                }
               
            });
          

        </script>
<script>
    let emergency = {}; // Variable global

    document.addEventListener('DOMContentLoaded', () => {
        const buttons = document.querySelectorAll('[data-emergency]');

        buttons.forEach(btn => {
            btn.addEventListener('click', () => {
                emergency = JSON.parse(btn.dataset.emergency);

                document.getElementById('sld-id').textContent = emergency.id;
                document.getElementById('sld-address').textContent = emergency.address ?? '–';
                document.getElementById('sld-type').textContent = emergency.type ?? '–';
                document.getElementById('sld-description').textContent = emergency.description ?? '–';
                document.getElementById('sld-priority').textContent = capitalize(emergency.priority);
                document.getElementById('sld-status').textContent = capitalize(emergency.status.replace('_', ' '));
                document.getElementById('sld-date').textContent = new Date(emergency.created_at).toLocaleString();

                updateUnitsList(emergency.units || []);
            });
        });
    });

    function updateUnitsList(units) {
      const container = document.getElementById('sld-units');
    if (!container) return;

    if (units.length === 0) {
        container.innerHTML = '<span class="text-gray-400 italic">Sin unidades asignadas</span>';
    } else {
        container.innerHTML = units.map(u => `
            <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full font-medium">
               🚒 ${u.code}
            </span>
        `).join('');
    }
    }

    function capitalize(str) {
        return str.charAt(0).toUpperCase() + str.slice(1);
    }
</script>

    </body>
</html>
