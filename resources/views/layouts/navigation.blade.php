<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="icon" href="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQYbYMpwVNrGj39HPPcodSyE7KPLB7UqM1Ny6WFAQx1Q3pld0TUf9xj6am2DYspgZPXQ58&usqp=CAU" type="image/png">
    <title>Professional Sidebar</title>
    <style>
        body {
            margin: 0;
            font-family: 'Ubuntu', sans-serif;
            background: linear-gradient(120deg, #f3f4f6, #e9ecef);
            transition: all 0.3s ease-in-out;
        }
        .a {
    color: rgb(255 255 255) !important;
    text-decoration: none !important;
    text-transform: uppercase !important;
}

        .sidebar {
    position: fixed;
    top: 0;
    left: 0;
    width: 75px;
    height: 100%;
    background: linear-gradient(180deg, #D32F2F, #C2185B);
    overflow-x: hidden;
    transition: width 0.4s ease-in-out;
    box-shadow: 3px 0 10px rgba(0, 0, 0, 0.1);
    border-top-right-radius: 15px;
    border-bottom-right-radius: 15px;
}

body.open .sidebar {
    width: 240px;
}

.sidebar-header {
    width: 100%;
    padding: 15px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    background: rgba(255, 255, 255, 0.1);
    border-bottom: 1px solid rgba(255, 255, 255, 0.2);
}

.sidebar-burger i {
    font-size: 24px;
    color: #fff;
    transition: color 0.3s;
}

.sidebar-burger:hover i {
    color: #f8bbd0;
}

.sidebar-menu button {
    width: 100%;
    display: flex;
    align-items: center;
    padding: 12px 20px;
    color: #fff;
    font-size: 16px;
    gap: 15px;
    background: none;
    border: none;
    transition: background 0.3s, transform 0.3s;
}

.sidebar-menu button:hover {
    background: rgba(255, 255, 255, 0.1);
    transform: scale(1.05);
}

.sidebar-menu button i {
    font-size: 24px;
    color: #fff;
}

.sidebar-menu button span {
    opacity: 0;
    white-space: nowrap;
    transition: opacity 0.4s ease-in-out;
    font-weight: 500;
    text-transform: uppercase;
}

body.open .sidebar-menu button span {
    opacity: 1;
}

.sidebar-menu button.has-border {
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    padding-bottom: 15px;
    margin-bottom: 10px;
}

a {
    color: inherit;
    text-decoration: none;
    transition: color 0.3s;
    
}

a:hover {
    color: #ffebee;
}


        .sidebar-footer {
            padding: 15px;
            text-align: center;
            color: #fff;
            font-size: 14px;
            background: rgba(255, 255, 255, 0.1);
        }
        .dropdown-container {
            position: relative;
            display: inline-block;
           
            border-radius: 10px;
           
            padding: 10px 15px 10;
            cursor: pointer;
        }

        .dropdown-container:hover .dropdown-menu {
            display: block;
            opacity: 1;
            transform: translateY(0);
        }

        .dropdown-container .icon {
            display: flex;
            align-items: center;
            font-size: 18px;
            color: #fff;
        }

        .dropdown-container .icon i {
            margin-right: 8px;
        }

        .dropdown-menu {
            position: absolute;
            top: 110%;
            left: 0;
            width: 200px;
            background: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            display: none;
            opacity: 0;
            transform: translateY(-10px);
            transition: all 0.3s ease-in-out;
            z-index: 1000;
        }

        .dropdown-menu .menu-item {
            padding: 12px 15px;
            font-size: 16px;
            color: #333;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 10px;
            transition: background 0.3s, color 0.3s;
        }

        .dropdown-menu .menu-item:hover {
            background: #f9f9f9;
            color: #D32F2F;
        }

        .dropdown-menu .menu-item i {
            font-size: 20px;
        }
        #i-fetch{
            font-size: 17px;
    
    margin-left: 7px;
        }

        .swal-popup {
        border: 2px solid #D32F2F; /* Border color for the popup */
        font-family: Arial, sans-serif;
    }

    .swal-title {
        color: #C2185B; /* Title color */
        font-size: 28px;
        font-weight: bold;
    }

    .swal-html-container {
        font-size: 16px;
        color: #333; /* Text color */
    }

    .swal-close-btn {
        background-color: #D32F2F !important; /* Close button color */
        color: white;
        border-radius: 50%;
        width: 40px;
        height: 40px;
    }

    .swal-close-btn:hover {
        background-color: #C2185B; /* Hover effect for close button */
    }

    .swal-popup a {
        font-size: 16px;
        text-decoration: none;
    }

    .swal-popup a:hover {
        color: #C2185B; /* Link hover color */
    }
    .swal-confirm-btn {
        background-color: #D32F2F; /* Button background color */
        color: white; /* Text color */
        border: none;
        border-radius: 5px; /* Rounded corners */
        font-size: 16px; /* Font size */
        padding: 10px 20px; /* Padding for better button size */
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Button shadow */
        cursor: pointer; /* Pointer cursor */
    }

    .swal-confirm-btn:hover {
        background-color: #C2185B; /* Change color on hover */
    }
    /* تحسين التجاوب */
/* @media (max-width: 768px) {
    .sidebar {
        width: 60px; 
    }

   

    .sidebar-header {
        justify-content: center; 
    }

    .dropdown-menu {
        left: auto;
        right: 0;
        width: 160px; 
    }
}


@media (max-width: 480px) {
    .sidebar {
        width: 50px; 
    }

    .sidebar-burger i {
        font-size: 20px; 
    }

    .sidebar-menu button i {
        font-size: 20px; 
    }
} */

.sidebar:hover {
    width: 240px; /* نفس العرض عند الفتح */
    transition: width 0.4s ease-in-out;
}


    </style>
</head>
<body>
    <nav class="sidebar">
        <div>
            <header class="sidebar-header">
                <div class="sidebar-burger" onclick="toggleSidebar()">
                    <i class='bx bx-menu'></i>
                </div>
            </header>
            <div class="sidebar-menu">
                 <button type="button">
                    <a href="{{ route('dashboard') }}"><i class='bx bx-home'></i></a>
                    
                    <span><a class="a" href="{{ route('dashboard') }}">accueil</a></span>
                </button>
                @can("user-list")
                <button type="button" class="has-border">
                    <a href="{{ route('users.index') }}"><i class='bx bx-group'></i></a>
                    <span><a class="a" href="{{ route('users.index') }}">Équipe</a></span>
                </button>
                @endcan

                <button type="button" class="has-border">
                    <a href="{{ route('login.history') }}"><i class="fas fa-history"></i></a>
                    <span><a class="a" href="{{ route('login.history') }}">Historique_session</a></span>
                </button>

                @can("objectif-list")
                <button type="button">
                   
                    <a href="{{ route('objectifs.index') }}"> <i class='bx bx-target-lock'></i></a>
                    <span><a class="a" href="{{ route('objectifs.index') }}">objectifs</a>
                    </span>
                </button>
                @endcan
                @can("reclamation-list")
                <button type="button">
                    
                    <a href="{{ route('reclamations.index') }}"><i class='bx bx-comment-detail'></i></a>
                    <span><a class="a" href="{{ route('reclamations.index') }}">reclamations</a>
                    </span>
                </button>
                @endcan
                @can("tache-list")
                <button type="button">
                                    
                         <a href="{{ route('taches.index') }}"><i class='bx bx-task'></i></a>
                    <span><a class="a" href="{{ route('taches.index') }}">les tâches</a></span>
                </button>
                @endcan
                @can("image_preuve-list")
                <button type="button">
                                    
                    <a href="{{ route('image_preuve.index') }}"><i class="fas fa-image"></i></a>
               <span><a class="a" href="{{ route('image_preuve.index') }}">image preuve</a></span>
           </button>
           @endcan
                @can("project-list")
                <button type="button">
                   
                    <a href="{{ route('projects.index') }}"> <i class='bx bx-briefcase'></i></a>
                    <span><a class="a" href="{{ route('projects.index') }}">projects</a></span>
                </button>
                @endcan
                @can("pointage-list")
                <button type="button">
                    
                    <a href="{{ route('suivre_pointage.index') }}"><i class='bx bx-time'></i></a>
                    <span><a class="a" href="{{ route('suivre_pointage.index') }}">pointage</a></span>
                </button>
                @endcan
                @can("formation-list")
                <button type="button">
                    
                    <a href="{{ route('formations.index') }}"><i class='bx bx-chalkboard'></i></a>
                    <span><a class="a" href="{{ route('formations.index') }}">formations</a></span>
                </button>
                @endcan

               @can("vente-list")
                <button type="button">
                    
                    <a href="{{ route('vente_objectifs.index') }}"><i class='bx bx-chart'></i></a>
                    <span><a class="a" href="{{ route('vente_objectifs.index') }}">Voir tous les  vente</a>
                    </span>
                </button>
                @endcan
                @can("role-list")
                <button type="button">
                    
                    <a href="{{ route('roles.index') }}"><i class="fas fa-user-shield"></i></a>
                    <span><a class="a" href="{{ route('roles.index') }}">roles</a>
                    </span>
                </button>
                @endcan
                <div class="dropdown-container">
                    <button class="icon" id="profileButton">
                        <i class='bx bx-user'></i><br>
                        <p class="p-fetch">Profile <i id="i-fetch" class="fa fa-chevron-down"></i></p>
                    </button>
                    <div class="dropdown-menu" id="dropdownMenu" style="display: none;">
                        <a href="{{ route('profile.edit') }}" class="menu-item">
                            <i class='bx bx-user-circle'></i>
                            {{ __('Profile') }}
                        </a>
                        <form method="POST" action="{{ route('logout') }}" style="margin: 0;">
                            @csrf
                            <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();" class="menu-item">
                                <i class='bx bx-log-out'></i>
                                {{ __('Log Out') }}
                            </a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        {{-- <div class="sidebar-footer">
            <p>&copy; 2024 Company Name</p>
        </div> --}}
    </nav>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.getElementById('profileButton').addEventListener('mouseenter', function () {
            Swal.fire({
                title: 'Profile Options',
                html: `
                    <a href="{{ route('profile.edit') }}" style="display:block; margin-bottom: 10px; color: #C2185B; font-size: 16px; text-decoration: none; background-color: #ff00000a;">
                        <i class='bx bx-user-circle' style="color: #C2185B;"></i> Profile
                    </a>
                    <a href="{{ route('logout') }}" style="display:block; margin-bottom: 10px; color: #D32F2F; font-size: 16px; text-decoration: none;background-color: #ff00000a;" onclick="event.preventDefault(); document.getElementById('logoutForm').submit();">
                        <i class='bx bx-log-out' style="color: #D32F2F;"></i> Log Out
                    </a>
                    <form id="logoutForm" method="POST" action="{{ route('logout') }}" style="display: none;">
                        @csrf
                    </form>
                `,
                showCloseButton: true,
                focusConfirm: false,
                confirmButtonText: 'Annuler',
                customClass: {
                    popup: 'swal-popup',
                    title: 'swal-title',
                    htmlContainer: 'swal-html-container',
                    closeButton: 'swal-close-btn',
                    confirmButton: 'swal-confirm-btn'  // Custom class for the confirm button
                },

                background: '#ffffff',  // Background color of the popup
                iconColor: '#C2185B',  // Icon color for the close button
                buttonsStyling: false,
                didOpen: () => {
                    // Style the popup text and links
                    const popup = document.querySelector('.swal-popup');
                    popup.style.padding = '20px';
                    popup.style.borderRadius = '10px';
                    popup.style.boxShadow = '0 4px 6px rgba(0, 0, 0, 0.1)';
                }
            });
        });
    </script>
    <script>
        const toggleSidebar = () => document.body.classList.toggle('open');
    </script>
    <script>
        document.querySelector('.sidebar').addEventListener('mouseenter', () => {
    document.body.classList.add('open');
});

document.querySelector('.sidebar').addEventListener('mouseleave', () => {
    document.body.classList.remove('open');
});

    </script>
   
</body>
</html>
