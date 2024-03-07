export const DOMReady = function (callback: any) {
    document.readyState === "interactive" || document.readyState === "complete"
        ? callback()
        : document.addEventListener("DOMContentLoaded", callback);
};
