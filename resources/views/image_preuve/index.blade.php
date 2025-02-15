{{-- resources/views/image_preuve/index.blade.php --}}
<x-app-layout>
    <style>
        /* Style de la modale */
        .modal {
            display: none; /* Caché par défaut */
            position: fixed; 
            z-index: 1000; 
            padding-top: 60px; 
            left: 0;
            top: 0;
            width: 100%; 
            height: 100%; 
            overflow: auto; 
            background-color: rgba(0, 0, 0, 0.8); /* Fond sombre avec opacité */
        }
        
        /* Image à l'intérieur de la modale */
        .modal-content {
            margin: auto;
            display: block;
            max-width: 80%; /* Largeur maximale */
            max-height: 80%; /* Hauteur maximale */
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.5);
            transition: transform 0.3s ease; /* Animation fluide */
        }
        
        /* Effet de zoom */
        .modal-content:hover {
            transform: scale(1.05); /* Zoom au survol */
        }
        
        /* Bouton de fermeture */
        .close {
            position: absolute;
            top: 15px;
            right: 35px;
            color: white;
            font-size: 30px;
            font-weight: bold;
            cursor: pointer;
            transition: color 0.3s ease;
        }
        
        .close:hover,
        .close:focus {
            color: #f00; /* Rouge au survol */
            text-decoration: none;
        }
        .modal-content {
    transform: scale(0.8);
    animation: zoomIn 0.4s ease;
}

@keyframes zoomIn {
    from {
        transform: scale(0.8);
        opacity: 0;
    }
    to {
        transform: scale(1);
        opacity: 1;
    }
}
body {
    font-family: 'Arial', sans-serif;
    background-color: #f9f9f9;
    margin: 0;
    padding: 0;
}

/* .container {
    max-width: 100% !important;
    margin: 50px auto;
    background: #fff;
    border-radius: 10px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    padding: 20px;
} */

h1 {
    color: #D32F2F;
    text-align: center;
    margin-bottom: 20px;
    font-size: 24px;
    font-weight: bold;
}

.btn {
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    color: #fff;
    font-size: 14px;
    cursor: pointer;
    text-decoration: none;
    transition: background-color 0.3s ease;
}

.btn-primary {
    background-color: #C2185B;
}

.btn-primary:hover {
    background-color: #D32F2F;
}

.btn-warning {
    background-color: #FFC107;
    color: #000;
}

.btn-info {
    background-color: #17A2B8;
}

.btn-danger {
    background-color: #D32F2F;
}

.table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

.table thead th {
    background-color: #D32F2F;
    color: #fff;
    text-align: left;
    padding: 10px;
}

.table tbody tr {
    border-bottom: 1px solid #ddd;
}

.table tbody td {
    padding: 10px;
    text-align: left;
}

.table tbody tr:hover {
    background-color: #f1f1f1;
}
body {
            font-family: 'Arial', sans-serif;
            background-color: #f9f9f9;
            color: #333;
            padding: 20px;
        }

        h2 {
            color: #D32F2F;
            font-size: 1.8rem;
            margin-bottom: 20px;
        }

        .search-form {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
           
        }

        .form-control {
            width: 400px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 20px 0 0 20px;
            font-size: 16px;
            outline: none;
           
            
        }

        .form-control:focus {
            border-color: #D32F2F;
        }

        .btn {
            background-color: #C2185B;
            color: #fff;
            border: none;
            padding: 10px 15px;
            border-radius: 0 20px 20px 0;
            cursor: pointer;
            transition: background-color 0.3s ease;
            justify-content: center !important;
    display: flex;
        }

        .btn:hover {
            background-color: #D32F2F;
        }

        .btn-primary {
    margin-top: 35px; /* Ajoute un espace au-dessus du bouton */
    margin-bottom: 15px; /* Espace en dessous */
    background-color: #D32F2F;
    border: none;
    padding: 10px 20px;
    font-size: 1rem;
    color: white;
    border-radius: 5px;
    
}
.button-container {
    
    display: flex;
    justify-content: center; /* Ajuste cette valeur pour descendre le bouton */
}



        .btn-primary:hover {
            background-color: #C2185B;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            background-color: #FFF;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.05);
            border-radius: 8px;
            overflow: hidden;
        }

        th {
            background-color: #C2185B;
            color: white;
            padding: 12px;
            text-align: left;
        }

        td {
            padding: 10px;
            border: 1px solid #EEE;
            text-align: center;
        }

        tr:nth-child(even) {
            background-color: #FFEFF3;
        }

        tr:hover {
            background-color: #FFCDD2;
            transition: background-color 0.3s ease-in-out;
        }

        .alert-success {
            background-color: #388E3C;
            color: white;
            padding: 10px;
            border-radius: 5px;
        }

        .pagination {
            margin-top: 20px;
            display: flex;
            justify-content: center;
        }

        .pagination a {
            color: #D32F2F;
            text-decoration: none;
            padding: 8px 12px;
            border: 1px solid #D32F2F;
            border-radius: 5px;
        }

        .pagination a:hover {
            background-color: #D32F2F;
            color: white;
        }

        .btn-info {
            background-color: #1976D2;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            color: white;
        }

        .btn-warning {
            background-color: #FF9800;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            color: white;
        }

        .btn-danger {
            background-color: #D32F2F;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            color: white;
        }

        .btn-danger:hover {
            background-color: #C2185B;
        }

        td.td-action {
            display: flex;
            gap: 10px;
            justify-content: center;
        }

        .input-group {
            display: flex;
            justify-content: center;
        }

        .btn-container {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 20vh; /* This ensures the button is centered vertically */
}

/* نافذة منبثقة (Modal) */
.modal {
    display: none; /* إخفاء النافذة بشكل افتراضي */
    position: fixed;
    z-index: 1;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgba(0,0,0,0.7); /* خلفية مظلمة */
}

/* محتوى النافذة المنبثقة */
.modal-content {
    margin: 5% auto;
    display: block;
    width: 80%;
    max-width: 900px;
}

/* زر الإغلاق */
.close {
    color: white;
    font-size: 40px;
    font-weight: bold;
    position: absolute;
    top: 10px;
    right: 25px;
    cursor: pointer;
}

.close:hover,
.close:focus {
    color: #999;
    text-decoration: none;
    cursor: pointer;
}
/* ضبط الفيديو ليظهر بشكل مناسب على جميع الأجهزة */
.video-container {
    width: 100%;
    max-width: 900px;  /* تحديد الحد الأقصى للعرض على الأجهزة الكبيرة */
    margin: 0 auto;  /* ضبط المحاذاة لتكون في المنتصف */
}

video {
    width: 100%;
    height: auto;  /* الحفاظ على نسبة العرض إلى الارتفاع */
    max-height: 80vh;  /* تحديد الحد الأقصى للطول على الأجهزة الكبيرة */
}

.responsive-image {
    width: 100%;
    height: auto; /* افتراضيًا يجعل الارتفاع تلقائيًا بناءً على العرض */
    border-radius: 15px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

/* تأثير التحويم */
.responsive-image:hover {
    transform: scale(1.05);
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3);
}

/* معالجة مشكلة العرض على الشاشات الكبيرة */
@media (min-width: 1024px) {
    .responsive-image {
        max-width: 500px; /* تحديد الحد الأقصى للعرض */
        margin: 0 auto; /* مركزة الصورة في الوسط */
    }
}


        </style>
        
        @can("image_preuve-list")
    <div class="container">
        <form method="GET" action="{{ route('image_preuve.index') }}">
            <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Rechercher..." value="{{ request('search') }}">
            <button type="submit" class="btn"><i class="fas fa-search"></i></button>
            </div>
        </form>
        
        {{-- <div class="btn-container"> --}}
         @can("image_preuve-create")
         <a href="{{ route('image_preuve.create') }}" class="btn btn-primary">Ajouter une nouvelle image preuve</a>
         @endcan
        {{-- </div> --}}
        <h2 class="mb-4">Liste des Images Preuves</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Titre</th>
                    <th>Description</th>
                    <th>Image</th>
                    <th>Date</th>
                    <th>Nom de l'utilisateur</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($imagePreuves as $imagePreuve)
                    <tr>
                        <td>{{ $imagePreuve->titre }}</td>
                        <td>{{ $imagePreuve->description }}</td>
                        <td>
                            <a href="javascript:void(0);" onclick="openModal('{{ Storage::url($imagePreuve->media) }}')">
                                @if (preg_match('/\.(jpg|jpeg|png|gif|svg)$/i', $imagePreuve->media))
                                    <img src="{{ Storage::url($imagePreuve->media) }}" alt="{{ $imagePreuve->titre }}" style="width: 100px; height: auto;">
                                @elseif (preg_match('/\.(mp4|mkv|avi|mov)$/i', $imagePreuve->media))
                                    <!-- عرض فيديو -->
                                    <i class="fas fa-video" style="font-size: 24px;"></i> <!-- أيقونة عرض الفيديو -->
                                @else
                                    <span style="color: red;">نوع الملف غير مدعوم</span>
                                @endif
                            </a>
                        </td>
                        
                        
                        
                        <!-- La modale pour afficher l'image en grand -->
                        <div id="imageModal" class="modal" onclick="closeModal()" style="display: none;">
                            <span class="close" onclick="closeModal()">&times;</span>
                            <div id="modalContent" style="max-width: 90%; max-height: 90%; margin: auto; background-color: #f72a2a06; text-align: center;"></div>
                        </div>
                        
                        
                        
                        <td>{{ $imagePreuve->date }}</td>
                        <td>{{ $imagePreuve->user->name }}</td>
                        <td class="td-action">
                            @can("image_preuve-edit")
                            <a href="{{ route('image_preuve.edit', $imagePreuve->id) }}" class="btn btn-warning"title="Modifier"><i class="fa fa-edit"></i></a>
                            @endcan
                            @can("image_preuve-show")
                            <a href="{{ route('image_preuve.download', $imagePreuve->id) }}" class="btn btn-info"title="Télécharger"><i class="fa fa-download"></i></a>
                            @endcan
                            @can("image_preuve-delete")
                            <form action="{{ route('image_preuve.destroy', $imagePreuve->id) }}" method="POST" style="display:inline-block;" id="delete-form-{{ $imagePreuve->id }}">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-danger" onclick="confirmDelete({{ $imagePreuve->id }})" title="Supprimer">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </form>
                            
                            
                            @endcan
                        </td>
                    </tr>
                    
                @endforeach
            </tbody>
        </table>
     

    </div>
    <div class="d-flex justify-content-center my-4">
        <nav aria-label="Page navigation">
            {{$imagePreuves->links('pagination.custom') }}
        </nav>
    </div>
    <script>
  function openModal(mediaUrl) {
    const modal = document.getElementById('imageModal');
    const modalContent = document.getElementById('modalContent');

    modalContent.innerHTML = ''; // تفريغ المحتوى السابق

    if (mediaUrl.match(/\.(jpg|jpeg|png|gif|svg)$/i)) {
        modalContent.innerHTML = `<img 
    src="${mediaUrl}" 
    class="responsive-image"/>`;
    } else if (mediaUrl.match(/\.(mp4|mkv|avi|mov)$/i)) {
        modalContent.innerHTML = `
        <div class="video-container">
            <video controls style="width:100%; height: auto;">
                <source src="${mediaUrl}" type="video/mp4">
                متصفحك لا يدعم عرض الفيديو.
            </video>
            </div>`;
    } else {
        modalContent.innerHTML = `<p style="color: red; text-align: center;">نوع الملف غير مدعوم.</p>`;
    }

    modal.style.display = 'block'; // عرض النافذة المنبثقة
}



// دالة إغلاق النافذة المنبثقة
function closeModal() {
    const modal = document.getElementById('imageModal');
    modal.style.display = 'none';
}

    </script>
     <script>
        document.addEventListener('DOMContentLoaded', function () {
            @if (session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Succès',
                    text: '{{ session('success') }}',
                    confirmButtonText: 'OK',
                   
                });
            @elseif (session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Erreur',
                    text: '{{ session('error') }}',
                    confirmButtonText: 'OK',
                  
                });
            @endif
        });
    </script>
    <script>
        function confirmDelete(id) {
            Swal.fire({
                title: 'Êtes-vous sûr ?',
                text: "Cette action est irréversible.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Oui, supprimer !',
                cancelButtonText: 'Annuler'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Soumettre le formulaire si l'utilisateur confirme
                    document.getElementById('delete-form-' + id).submit();
                }
            });
        }
    </script>
    
    @endcan
    
</x-app-layout>

