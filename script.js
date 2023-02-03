let file_name;
let temp_name = 0;
const input_arr = [document.querySelector("form .attachments p.file_warning")];
const get_input = document.querySelector("form .attachments .file");
const input_warning = document.querySelector("form .attachment .file_warning");
const get_file = document.querySelector("form .attachments input");
// console.log(get_file);
file_check(get_input);
let count_size = 0
//input_click
function create_input() {
    const get_input_block = document.querySelector("form .attachments div");
    const input_element = document.createElement("input");
    input_element.classList = "file";
    input_element.name = "userfile" + temp_name++;
    input_element.accept = ".pdf,.bmp,.jpg,.jpeg,.png";
    input_element.type = "file";
    get_input_block.appendChild(input_element);
    return input_element;
}

let format = [".pdf", ".bmp", ".jpg", ".jpeg", ".png"];

function file_check(item) {
    const get_format_warning = document.querySelector("form .attachments p.file_warning_format");
    const get_size_warning = document.querySelector("form .attachments p.file_warning_size");
    item.addEventListener("change", (e) => {
        let error = [];
        // [...item.files].forEach((item_file) => {
        //     file_check(item_file)
        // }) //  сделать чтобы под каждый файл создвался новый инпут. после проверки на все условия.
        file_name = item.files[0].name;
        if (item.files[0].size >= 50000000) {
            item.value = '';
            get_size_warning.style.display = "block";
            error.push('size');
        } else {
            get_size_warning.style.display = "none";
            count_size += item.files[0].size;
            if (count_size >= 50 * 1024 * 1024) {
                error.push('max_size');

            }
        }

        if (error.length !== 0) {
            item.value = '';
            get_format_warning.style.display = "block";
        } else {
            format.some(function (item_nes) {
                if (file_name.toLowerCase().indexOf(item_nes) !== -1) {
                    error.pop();
                    let new_item = create_input();
                    file_check(new_item);
                    get_format_warning.style.display = "none";
                    return true;
                } else {
                    error[0] = "Ошибка";
                }
            });
        }
    });
}