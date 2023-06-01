@extends('layouts.user.layout')

@section('content')

    <section class="container py-4">
        <h4 class="text-center fw-bold">{{$category['name_'.$lang]}}</h4>

        <div class="row">
            <h3 class="text-capitalize fw-bold"><span class="text-danger">Select</span> muscle </h3>
            <div class="d-flex my-2" id="parts_names_container">

            </div>
            <div class="row">
                <div class="col-8" id="part_image_container">

                </div>
                <div class="col-4">
                    <div class="sidenav-content d-flex flex-column align-items-center justify-content-center h-100"
                         id="muscles_container">
                    </div>
                </div>
                <div class="col-12 my-3" id="part_files_container">

                </div>
            </div>
        </div>

    </section>

@endsection
@section('scripts')
    <script>

        try {

            getMuscles()
        } catch (error) {
            console.error(error)
        }

        let lang = '{{$lang}}'
        let url = 'gym.test';


        let checkedMuscle = 0;

        async function getMuscles() {
            let muscles_container = document.getElementById('muscles_container');
            let response = await fetch('/api/muscles', {
                method: 'GET'
            })
            let result = await response.json()

            if (result.status === 200) {
                let html = ''
                result.data.forEach((muscle) => {
                    html += `
                    <a style="cursor: pointer" onclick="showMuscleParts(${muscle['id']})" class="nav-link my-3 fs-6">${muscle[`title_${lang}`]}</a>
                    `
                })
                muscles_container.innerHTML = html;
            }
        }

        let checkedPartId = 0;

        async function showMuscleParts(muscle_id) {
            let parts_names_container = document.getElementById('parts_names_container');
            let part_image_container = document.getElementById('part_image_container')

            if (checkedMuscle !== muscle_id) {


                let response = await fetch(`/api/muscles/${muscle_id}/parts`, {
                    method: 'GET'
                })
                let result = await response.json()
                if (result.status === 200) {
                    let html = ''
                    let muscle_id = result.data['id']
                    let muscle_name = result.data['title_' + lang]
                    result.data.parts.forEach((part) => {
                        html += `

                    <a  class="btn  btn-outline-danger me-1" onclick="showPartFiles(${muscle_id},'${muscle_name}',${part['id']},'${part['cover_image']}')">${part['title']}</a>
                    `
                    })

                    parts_names_container.innerHTML = html;
                    if (result.data.parts[0]) {
                        showPartFiles(muscle_id, muscle_name, result.data.parts[0]['id'], result.data.parts[0]['cover_image'])
                        checkedPartId = result.data.parts[0]['id'];
                    } else {
                        showPartFiles(muscle_id, muscle_name, 0, '')
                    }
                    checkedMuscle = muscle_id;
                }
            }
        }

        async function showPartFiles(muscle_id, muscle_name, part_id, part_image) {


            let part_files_container = document.getElementById('part_files_container');
            let part_image_container = document.getElementById('part_image_container')

            if (part_image) {
                part_image_container.innerHTML = `
            <img id="part_image" class="w-100 h-100 rounded" src="/${part_image}" alt="">
            `
            } else {
                part_image_container.innerHTML = ``;
            }

            if (part_id) {
                if (checkedPartId !== part_id) {


                    let response = await fetch(`/api/muscles/${muscle_id}/${part_id}/files`, {
                        method: 'GET'
                    })
                    let result = await response.json()


                    if (result.status === 200) {
                        let html = ` <h3 id="muscle_name">${muscle_name}</h3>`
                        result.data.forEach((file) => {
                            html += `
                        <div class="my-2 d-flex align-items-center">
                         <i class="fa-light fa-file "></i>
                        <a style="cursor: pointer;" href="/${file['path']}" target="_blank" class="text-danger mx-1 fs-5" >${file['title']}</a>
                        </div>

                        `
                        })

                        part_files_container.innerHTML = html;

                    }

                    checkedPartId = part_id
                }

            }else{
                part_files_container.innerHTML = null;
            }
        }

    </script>

    <script>

    </script>
@endsection
