var canvas = new fabric.Canvas("c");
let selectedObject;
function objectSelectedUpdated(_obj) {
    // console.log(_obj);
    if (!_obj.selected || !_obj.selected.length) return;
    const obj = _obj.selected[0];
    setSelectedObject(obj);
}
function init() {
    canvas.selection = false;
    canvas.on("selection:created", function (obj) {
        objectSelectedUpdated(obj);
    });
    canvas.on("selection:updated", function (obj) {
        objectSelectedUpdated(obj);
    });
    canvas.on("selection:cleared", function (obj) {
        setSelectedObject(undefined);
    });

    const img =
        "<img src='./blank-t-shirt.jpg' height='500px' style='position: absolute; height: 500px; width: 500px' alt='' id='canvasBg' />";
    const canvasBgImage = getEl("canvasBgImage");
    canvasBgImage.innerHTML += img;
}
init();

function removeObject() {
    canvas.remove(canvas.getActiveObject());
}

function setSelectedObject(obj) {
    selectedObject = obj;
    const el = getEl("editables");
    const deleteBtn = `<button   class="p-2 px-3 w-[200px] bg-red-500 text-white border rounded-lg"   onclick="removeObject()"  oninput="removeObject()" >Delete</button>`;
    let innerHTML = "";
    if (selectedObject) {
        innerHTML += deleteBtn;

        if (
            selectedObject.type === "textbox"
            // selectedObject.type === "line" ||
            // selectedObject.type === "circle" ||
            // selectedObject.type === "triangle" ||
            // selectedObject.type === "rect"
        ) {
            const fill = selectedObject.fill;
            innerHTML += `  <input   type="color"   id="colorpicker"   value="${fill}"   onchange="setTextColour()" />`;
        }
        if (selectedObject && selectedObject.type === "textbox") {
            // console.log("selectedObject.fontStyle", selectedObject.fontStyle);
            const isBold = selectedObject.fontWeight === "bold";
            const fontFamily = selectedObject.fontFamily;
            const isItalic = selectedObject.fontStyle === "italic";
            const underline = selectedObject.underline;
            const linethrough = selectedObject.linethrough;
            const overline = selectedObject.overline;
            innerHTML += `<label for="font-family" style="display: inline-block">
          Font family:
        </label>
        <select
          id="font-family"
          class="w-[130px] border"
          onchange="seFontFamily()"
        >
          <option value="arial" ${
              fontFamily === "arial" && "selected"
          }>Arial</option>
          <option value="Pacifico" ${
              fontFamily === "Pacifico" && "selected"
          }>Pacifico</option>
          <option value="helvetica" ${
              fontFamily === "helvetica" && "selected"
          }>Helvetica</option>
          <option value="myriad pro" ${
              fontFamily === "myriad pro" && "selected"
          }>Myriad Pro</option>
          <option value="verdana" ${
              fontFamily === "verdana" && "selected"
          }>Verdana</option>
          <option value="georgia" ${
              fontFamily === "georgia" && "selected"
          }>Georgia</option>
          <option value="courier" ${
              fontFamily === "courier" && "selected"
          }>Courier</option>
          <option value="comic sans ms" ${
              fontFamily === "comic sans ms" && "selected"
          }>Comic Sans MS</option>
          <option value="impact" ${
              fontFamily === "impact" && "selected"
          }>Impact</option>
          <option value="monaco" ${
              fontFamily === "monaco" && "selected"
          }>Monaco</option>
          <option value="optima" ${
              fontFamily === "optima" && "selected"
          }>Optima</option>
          <option value="hoefler text"  ${
              fontFamily === "hoefler text" && "selected"
          }>Hoefler Text</option>
          <option value="engagement" ${
              fontFamily === "engagement" && "selected"
          }>Engagement</option>
        </select>
        <label for="font-style" style="display: inline-block">
          Font style:
        </label>
        <div id="text-controls-additional" class="flex gap-2">
          <input
            type="checkbox"
            name="fonttype"
            id="text-bold"
            onclick="textBold()"
            ${isBold && "checked"}
            />
            Bold
            <input
            type="checkbox"
            name="fonttype"
            id="text-italic"
            onclick="textItalic()"
            ${isItalic && "checked"}
            />
            Italic
            <input
            type="checkbox"
            name="fonttype"
            id="text-underline"
            onclick="textUnderline()"
            ${underline && "checked"}
            />
            Underline
            <input
            type="checkbox"
            name="fonttype"
            id="text-linethrough"
            onclick="textLinethrough()"
            ${linethrough && "checked"}
            />
            Linethrough
            <input
            type="checkbox"
            name="fonttype"
            id="text-overline"
            onclick="textOverline()"
            ${overline && "checked"}
          />
          Overline
        </div>
      `;
        }
    }
    el.innerHTML = innerHTML;
}
function cleanForSelection() {
    getEl("canvasBg").remove();
}

function setSelected(selected) {
    cleanForSelection();
    let img;
    if (selected === 1) {
        img = ` <img   src="./blank-t-shirt.jpg"   height="500px"   style="position: absolute; height: 500px; width: 500px"   alt=""   id="canvasBg" />`;
        getEl("text-controls-additional").hidden = false;
    } else if (selected === 2) {
        img = ` <img    src="./poster.jpg"    style="position: absolute;top: 35px; left: 100px;height: 330px;width: 330px"    alt=""    id="canvasBg"  />`;
    } else if (selected === 3) {
        img = ` <img src="./signage.jpg" height="500px" style="position: absolute;left: 120px;top: 8px;height: 435px;width: 300px" alt="" id="canvasBg" />`;
    }
    if (selected !== 1) {
        getEl("text-controls-additional").hidden = true;
    }
    const canvasBgImage = getEl("canvasBgImage");
    canvasBgImage.innerHTML += img;
}

function getEl(id) {
    return document.getElementById(id);
}

function addLine() {
    canvas.add(
        new fabric.Line([100, 100, 200, 200], {
            left: 80,
            top: 80,
            stroke: "red",
        })
    );
}
function addRect() {
    var rect = new fabric.Rect({
        left: 80,
        top: 80,
        fill: "red",
        width: 20,
        height: 20,
    });

    canvas.add(rect);
}

function addCircle() {
    var circle = new fabric.Circle({
        radius: 20,
        fill: "red",
        left: 100,
        top: 100,
    });

    canvas.add(circle);
}
function addTriangle() {
    var triangle = new fabric.Triangle({
        width: 20,
        height: 30,
        fill: "red",
        left: 50,
        top: 50,
    });

    canvas.add(triangle);
}

function setShowModal(bool) {
    const el = getEl("modal");
    el.hidden = !bool;
}
function submitImgUrl() {
    const el = getEl("imgUrl");
    console.log(el.value);
    addImage(el.value);
}

function addImage(imgUrl) {
    // const imgUrl =
    //   "https://cloudfour.com/examples/img-currentsrc/images/kitten-small.png";

    fabric.Image.fromURL(
        imgUrl,
        function (oImg) {
            oImg.scale(0.5);
            canvas.add(oImg);
        },
        { crossOrigin: "Anonymous" }
    );
    setShowModal(false);
}
function addObjectImage(imgUrl) {
    // const imgUrl =
    //   "https://cloudfour.com/examples/img-currentsrc/images/kitten-small.png";
    imgUrl = "http://127.0.0.1:8000/objects/" + imgUrl;
    fabric.loadSVGFromURL(
        imgUrl,
        function (objects, options) {
            var svgData = fabric.util.groupSVGElements(objects, options);
            svgData.top = 30;
            svgData.left = 50;
            svgData.scaleToWidth(100);
            svgData.scaleToHeight(100);
            canvas.add(svgData);
        }
        // { crossOrigin: "Anonymous" }
    );
    setShowModal(false);
}

function addText(text) {
    text = text ? text : "Sample_Text";
    var text = new fabric.Textbox(text, {
        width: 50,
        fontSize: 30,
        fontFamily: "arial",
    });
    canvas.add(text);
}
function setTextColour() {
    if (selectedObject) {
        const c = getEl("colorpicker").value;
        console.log(selectedObject);

        selectedObject.set("fill", c);
        canvas.renderAll();
    }
}
function seFontFamily() {
    const fontFamily = getEl("font-family").value;
    console.log("seFontFamily", selectedObject.set, fontFamily);
    if (selectedObject) {
        // console.log(selectedObject);
        selectedObject.set("fontFamily", fontFamily);
        canvas.renderAll();
    }
}

function textBold() {
    const checked = getEl("text-bold").checked;
    if (checked) selectedObject.set("fontWeight", "bold");
    else selectedObject.set("fontWeight", "normal");
    canvas.renderAll();
}
function textItalic() {
    const checked = getEl("text-italic").checked;
    if (checked) selectedObject.set("fontStyle", "italic");
    else selectedObject.set("fontStyle", "");
    canvas.renderAll();
}
function textUnderline() {
    const checked = getEl("text-underline").checked;
    if (checked) selectedObject.set("underline", true);
    else selectedObject.set("underline", false);
    canvas.renderAll();
}
function textLinethrough() {
    const checked = getEl("text-linethrough").checked;
    if (checked) selectedObject.set("linethrough", true);
    else selectedObject.set("linethrough", false);
    canvas.renderAll();
}
function textOverline() {
    const checked = getEl("text-overline").checked;
    if (checked) selectedObject.set("overline", true);
    else selectedObject.set("overline", false);
    canvas.renderAll();
}

function htmltoCanvas() {
    console.log("Canvas Objects: ");
    // canvas.getObjects().forEach((element, i) => {
    //     console.log(i, element);
    // });
    console.log({
        sync_product: {
            external_id: "4235234213",
            name: "T-shirt",
            thumbnail:
                "*https://media.istockphoto.com/id/491520707/photo/sample-red-grunge-round-stamp-on-white-background.jpg?s=612x612&w=0&k=20&c=FW80kR5ilPkiJtXZEauGTghNBOgQviVPxAbhLWwnKZk=",
            is_ignored: true,
        },
        sync_variants: [
            {
                external_id: "12312414",
                variant_id: 3001,
                retail_price: "29.99",
                is_ignored: true,
                sku: "SKU1234",
                files: [
                    {
                        type: "default",
                        url: "https://media.istockphoto.com/id/491520707/photo/sample-red-grunge-round-stamp-on-white-background.jpg?s=612x612&w=0&k=20&c=FW80kR5ilPkiJtXZEauGTghNBOgQviVPxAbhLWwnKZk=",
                        options: [
                            {
                                id: "template_type",
                                value: "native",
                            },
                        ],
                        filename: "shirt1.png",
                        visible: true,
                    },
                ],
                options: [
                    {
                        id: "embroidery_type",
                        value: "flat",
                    },
                ],
                availability_status: "active",
            },
        ],
    });
    (obj) => obj.name === "test";
    // html2canvas(document.getElementById("canvasParent")).then((canvas) => {
    let a = document.createElement("a");
    let dt = canvas.toDataURL({
        format: "png",
        quality: 1,
    });
    fetch(dt).then((base64Response) => {
        base64Response.blob().then((file) => {
            var formdata = new FormData();
            formdata.append("file", file, "test.jpg");

            var requestOptions = {
                method: "POST",
                body: formdata,
                redirect: "follow",
            };
            Toastify({
                text: "Please Wait..",
                className: "warn",
            }).showToast();
            fetch("http://localhost:8000/api/file", requestOptions)
                .then((response) => response.text())
                .then((result) => {
                    console.log("imageURL", result);
                    createProduct(result);
                })
                .catch((error) => console.log("error", error));

            // dt = dt.replace(/^data:image\/[^;]*/, "data:application/octet-stream");
            // dt = dt.replace(
            //     /^data:application\/octet-stream/,
            //     "data:application/octet-stream;headers=Content-Disposition%3A%20attachment%3B%20filename=Canvas.png"
            // );

            // a.href = dt;
            // a.download = "canvas.png";
            // a.click();
        });
    });
    // });
}

getEl("image-picker").onchange = function onImagePikked(e) {
    if (!e.target.files?.length) return;
    console.log(e.target.files[0]);
    addImageFromFile(e);
};
function addImageFromFile(e) {
    if (!e.target.files?.length) return;
    if (!fabric) return;
    var reader = new FileReader();
    reader.onload = function (event) {
        var imgObj = new Image();
        imgObj.src = event.target.result;
        imgObj.onload = function () {
            var image = new fabric.Image(imgObj);
            // image.set({
            //   // angle: 0,
            //   // padding: 10,
            //   // cornersize: 10,
            //   // height: 110,
            //   // width: 110,
            //   scaleX: 0.1,
            //   scaleY: 0.1,
            // });
            canvas.centerObject(image);
            canvas.add(image);
            canvas.renderAll();
        };
    };
    reader.readAsDataURL(e.target.files[0]);
}

function calculateShippingRate() {
    var myHeaders = new Headers();
    myHeaders.append("X-PF-Store-Id", "12631976");
    myHeaders.append("Content-Type", "application/json");
    myHeaders.append("Accept", "application/json");
    myHeaders.append(
        "Authorization",
        "Bearer te6lqpl4ju9anm3y0TWtWTLaAVDiQz6ddtAspwJc"
    );

    var raw = JSON.stringify({
        recipient: {
            address1: "Mr John Smith. 132, My Street, Kingston, New York 12401",
            city: "New York",
            country_code: "US",
            state_code: "NY",
        },
        items: [
            {
                quantity: 1,
                variant_id: 1,
            },
        ],
    });

    var requestOptions = {
        method: "POST",
        headers: myHeaders,
        body: raw,
        redirect: "follow",
    };

    fetch("https://api.printful.com/shipping/rates", requestOptions)
        .then((response) => response.text())
        .then((result) => console.log("Shipping Rate \n", result))
        .catch((error) => console.log("error", error));
}

function createProduct(imageUrl) {
    var myHeaders = new Headers();
    myHeaders.append("Content-Type", "application/json");
    var requestOptions = {
        method: "POST",
        body: JSON.stringify({ imageUrl }),
        headers: myHeaders,
        redirect: "follow",
    };
    fetch("http://localhost:8000/api/createProduct", requestOptions)
        .then((response) => response.text())
        .then((result) => {
            const data = JSON.parse(result);
            console.log("createProduct", data);
            getProduct(data.result.id);
            Toastify({
                text: "Product Created!",
                className: "info",
            }).showToast();
        })
        .catch((error) => console.log("error", error));
}
function getProduct(id) {
    var myHeaders = new Headers();
    myHeaders.append("Content-Type", "application/json");
    var requestOptions = {
        method: "POST",
        body: JSON.stringify({ id }),
        headers: myHeaders,
        redirect: "follow",
    };
    fetch("http://localhost:8000/api/getProduct", requestOptions)
        .then((response) => response.text())
        .then((result) => {
            console.log("getProduct", JSON.parse(result));
            createOrder(JSON.parse(result));
        })
        .catch((error) => console.log("error", error));
}

function createOrder(product) {
    calculateShippingRate();

    var jsonString = JSON.stringify({
        ...orderData,
        items: product.result.sync_variants,
    });

    var myHeaders = new Headers();
    myHeaders.append("Content-Type", "application/json");
    var requestOptions = {
        method: "POST",
        body: JSON.stringify({ jsonString }),
        headers: myHeaders,
        redirect: "follow",
    };
    fetch("http://localhost:8000/api/createOrder", requestOptions)
        .then((response) => response.text())
        .then((result) => {
            console.log("createOrder", JSON.parse(result));
            Toastify({
                text: "Order Placed",
                className: "success",
            }).showToast();
        })
        .catch((error) => console.log("error", error));
}

const orderData = {
    shipping: "STANDARD",
    recipient: {
        name: "John Smith",
        company: "John Smith Inc",
        address1: "19749 Dearborn St",
        address2: "string",
        city: "Chatsworth",
        state_code: "CA",
        state_name: "California",
        country_code: "US",
        country_name: "United States",
        zip: "91311",
        phone: "9090909090",
        email: "test@gmail.com",
    },
    items: [
        {
            id: 4158580919,
            external_id: "655c5518866953",
            sync_product_id: 327738717,
            name: "test - 18″×24″",
            synced: true,
            variant_id: 1,
            main_category_id: 55,
            warehouse_product_variant_id: null,
            retail_price: null,
            sku: null,
            currency: "USD",
            options: [],
            quantity: 1,
            price: "13.00",
            product: {
                variant_id: 1,
                product_id: 1,
                image: "https://files.cdn.printful.com/products/1/1_1527683474.jpg",
                name: "Enhanced Matte Paper Poster 18″×24″",
            },
            files: [
                {
                    id: 639790705,
                    type: "default",
                    hash: "7980a4057ebcfe4df05850e60ca32307",
                    url: "https://img.photographyblog.com/reviews/kodak_pixpro_fz201/photos/kodak_pixpro_fz201_01.jpg",
                    filename: "kodak_pixpro_fz201_01.jpg",
                    mime_type: "image/jpeg",
                    size: 4273221,
                    width: 4608,
                    height: 3456,
                    dpi: 72,
                    status: "ok",
                    created: 1700548905,
                    thumbnail_url:
                        "https://files.cdn.printful.com/files/798/7980a4057ebcfe4df05850e60ca32307_thumb.png",
                    preview_url:
                        "https://files.cdn.printful.com/files/798/7980a4057ebcfe4df05850e60ca32307_preview.png",
                    visible: true,
                    is_temporary: false,
                    stitch_count_tier: null,
                },
                {
                    id: 639793848,
                    type: "preview",
                    hash: "71221e908e9e26d50d3c888a6f246e43",
                    url: null,
                    filename:
                        "enhanced-matte-paper-poster-(in)-18x24-front-655c551c796fc.png",
                    mime_type: "image/png",
                    size: 577217,
                    width: 1000,
                    height: 1000,
                    dpi: null,
                    status: "ok",
                    created: 1700549917,
                    thumbnail_url:
                        "https://files.cdn.printful.com/files/712/71221e908e9e26d50d3c888a6f246e43_thumb.png",
                    preview_url:
                        "https://files.cdn.printful.com/files/712/71221e908e9e26d50d3c888a6f246e43_preview.png",
                    visible: false,
                    is_temporary: false,
                    stitch_count_tier: null,
                },
            ],
            discontinued: true,
            out_of_stock: true,
        },
    ],
    retail_costs: {
        currency: "USD",
        subtotal: "10.00",
        discount: "0.00",
        shipping: "5.00",
        tax: "0.00",
    },
    gift: {
        subject: "To John",
        message: "Have a nice day",
    },
    packing_slip: {},
};
