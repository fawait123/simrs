require("./bootstrap");

function getData() {
    fetch(url)
        .then((res) => res.json())
        .then((data) => {
            let results = data.results;

            if (results.length > 0) {
                let html = "";
                results.map((el, index) => {
                    let name = el?.patient?.name || "";
                    html += `<tr style="background: ${
                        index == 0
                            ? "#19376D"
                            : el.userID == userID
                            ? "#A5D7E8"
                            : ""
                    }">
                                <td>
                                    <div
                                        style="width: 50px; height: 50px; background: ${
                                            index == 0 ? "#A5D7E8" : "#19376D"
                                        }; border-radius: 50%;display: flex; align-items: center; justify-content: center;">
                                        <b class="text-white">${name[0]}</b>
                                    </div>
                                </td>
                                <td>
                                    <h6 class="font-size-15 mb-1 fw-normal" style="color:${
                                        index == 0 ? "white" : ""
                                    }"><b>${el?.patient?.name}</b></h6>
                                    <p class="text-muted font-size-13 mb-0"><i
                                            class="mdi mdi-map-marker"></i> ${
                                                el?.patient?.village
                                            }</p>
                                </td>
                                <td>
                                    <b  style="color:${
                                        index == 0 ? "white" : ""
                                    }">${el.registrationID}</b>
                                </td>
                                <td>
                                    <b  style="color:${
                                        index == 0 ? "white" : ""
                                    }">${++index}</b>
                                </td>
                            </tr>`;
                });

                document.getElementById("list-data-queue").innerHTML = html;
                document.getElementById("queue-total").innerText =
                    results.length;
            }
        });
}

getData();

console.log("okey connect...");

Echo.channel("queue-channel").listen("QueueEvent", (e) => {
    console.log("event register");
    getData();
});
