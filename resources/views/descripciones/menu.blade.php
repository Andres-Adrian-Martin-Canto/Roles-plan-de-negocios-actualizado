<div class="bg-gray-100 dark:bg-gray-800 text-gray-800 dark:text-white shadow-sm rounded-lg p-4">
    <ul class="space-y-4">
        <!-- Primer enlace -->
        <li>
            <a href="{{ route('plan_de_negocio.descripciones.index', $plan_de_negocio) }}"
                class="flex items-center text-gray-800 dark:text-white hover:text-blue-400 dark:hover:text-blue-300 transition-all duration-200">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                    class="bi bi-card-checklist mr-3" viewBox="0 0 16 16">
                    <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m-5 6s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zM11 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5m.5 2.5a.5.5 0 0 0 0 1h4a.5.5 0 0 0 0-1zm2 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1zm0 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1z" />
                </svg>
                <span class="text-base font-medium">Lista de Descripciones</span>
            </a>
        </li>
        <!-- Segundo enlace -->
        <li>
            <a href="{{ route('plan_de_negocio.organigramas.index', $plan_de_negocio) }}"
                class="flex items-center text-gray-800 dark:text-white hover:text-blue-400 dark:hover:text-blue-300 transition-all duration-200">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                    class="bi bi-building mr-3" viewBox="0 0 16 16">
                    <path
                        d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2z" />
                    <path d="M7 5.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5m-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 1 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0" />
                </svg>
                <span class="text-base font-medium">Organigrama</span>
            </a>
        </li>
        <!-- Tercer enlace -->
        <li>
            <a href="{{ route('plan_de_negocio.proyecciones.index', $plan_de_negocio) }}"
                class="flex items-center text-gray-800 dark:text-white hover:text-blue-400 dark:hover:text-blue-300 transition-all duration-200">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                    class="bi bi-graph-up-arrow mr-3" viewBox="0 0 16 16">
                    <path
                        d="M0 0h1v15h15v1H0V0zm15.854 3.646a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708 0L7 8.707 3.854 11.854a.5.5 0 1 1-.708-.708l3.5-3.5a.5.5 0 0 1 .708 0L10 8.293l5.146-5.147a.5.5 0 0 1 .708 0z" />
                </svg>
                <span class="text-base font-medium">Proyección de Sueldo</span>
            </a>
        </li>
        <!-- Cuarto enlace -->
        <li>
            <a href="{{ route('plan_de_negocio.proyecciones.resumen', $plan_de_negocio) }}"
                class="flex items-center text-gray-800 dark:text-white hover:text-blue-400 dark:hover:text-blue-300 transition-all duration-200">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                    class="bi bi-file-earmark-bar-graph mr-3" viewBox="0 0 16 16">
                    <path
                        d="M14 4.5V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h5.5L14 4.5zM4 1.5a.5.5 0 0 0-.5.5v12a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5V5h-3.5a.5.5 0 0 1-.5-.5V1H4z" />
                    <path d="M6 12a.5.5 0 0 1-.5-.5V10a.5.5 0 0 1 1 0v1.5a.5.5 0 0 1-.5.5zm2 0a.5.5 0 0 1-.5-.5V8a.5.5 0 0 1 1 0v3.5a.5.5 0 0 1-.5.5zm2 0a.5.5 0 0 1-.5-.5v-5a.5.5 0 0 1 1 0v5.5a.5.5 0 0 1-.5.5z" />
                </svg>
                <span class="text-base font-medium">Resumen</span>
            </a>
        </li>
    </ul>
</div>
