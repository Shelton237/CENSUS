import useTranslation from "next-translate/useTranslation";
import { useContext, useEffect, useMemo, useState } from "react";

import { FiRefreshCw } from "react-icons/fi";

import Dashboard from "@pages/user/dashboard";
import OrderServices from "@services/OrderServices";
import Loading from "@components/preloader/Loading";
import { SidebarContext } from "@context/SidebarContext";
import useUtilsFunction from "@hooks/useUtilsFunction";
import { notifyError, notifySuccess } from "@utils/toast";

const STATUS_LABELS = {
  Pending: 'OT_Status_Pending',
  Sorting: 'OT_Status_Sorting',
  ReadyForDelivery: 'OT_Status_Ready',
  Processing: 'OT_Status_Processing',
  Delivered: 'OT_Status_Delivered',
  Cancel: 'OT_Status_Cancel',
};

const CustomerOrderTracking = () => {
  const { t } = useTranslation('common');
  const { isLoading, setIsLoading } = useContext(SidebarContext);
  const { currency, getNumberTwo, showDateFormat, showDateTimeFormat } =
    useUtilsFunction();

  const [board, setBoard] = useState({});
  const [statuses, setStatuses] = useState(Object.keys(STATUS_LABELS));
  const [loadingBoard, setLoadingBoard] = useState(true);
  const [error, setError] = useState("");
  const [lastUpdated, setLastUpdated] = useState(null);
  const [actionId, setActionId] = useState(null);

  const loadBoard = async () => {
    setLoadingBoard(true);
    setError("");
    try {
      const res = await OrderServices.getOrderBoard({ limit: 20 });
      setBoard(res?.board || {});
      if (Array.isArray(res?.statuses) && res.statuses.length > 0) {
        setStatuses(res.statuses);
      }
      setLastUpdated(new Date());
    } catch (err) {
      const message = err?.response?.data?.message || err?.message;
      setError(message);
      notifyError(message);
    } finally {
      setLoadingBoard(false);
    }
  };

  useEffect(() => {
    setIsLoading(false);
    loadBoard();
  }, []);

  const lastUpdatedLabel = useMemo(() => {
    if (!lastUpdated) return "—";
    return showDateTimeFormat(lastUpdated, "DD/MM/YYYY", "HH:mm");
  }, [lastUpdated, showDateTimeFormat]);

  const handleConfirmDelivery = async (orderId) => {
    setActionId(orderId);
    try {
      const res = await OrderServices.confirmDelivery(orderId);
      notifySuccess(
        res?.message || "Merci ! Votre livraison est maintenant confirmée."
      );
      await loadBoard();
    } catch (err) {
      const message = err?.response?.data?.message || err?.message;
      notifyError(message);
    } finally {
      setActionId(null);
    }
  };

  const renderCard = (order) => {
    const canConfirm =
      ["Processing", "ReadyForDelivery"].includes(order?.status) &&
      !order?.deliveryPlan?.confirmedByCustomer;

    return (
      <div
        key={order._id}
        className="p-4 border border-gray-100 rounded-md bg-white shadow-sm space-y-2"
      >
        <div className="flex items-center justify-between text-sm font-semibold text-gray-700">
          <span>{t('OT_Order_Num')}{order?.invoice}</span>
          <span>
            {currency}
            {getNumberTwo(order?.total)}
          </span>
        </div>
        <div className="text-xs text-gray-500 space-y-1 font-sans">
          <p>{t('OT_Client')}{order?.user_info?.name || "—"}</p>
          <p>
            {t('OT_Update')}
            {order?.updatedAt ? showDateFormat(order.updatedAt) : "—"}
          </p>
          {order?.deliveryPlan?.assignedDriver && (
            <p>{t('OT_Driver')}{order.deliveryPlan.assignedDriver}</p>
          )}
          {order?.deliveryPlan?.deliveryDate && (
            <p>
              {t('OT_Scheduled')}
              {showDateFormat(order.deliveryPlan.deliveryDate)}
            </p>
          )}
        </div>
        {canConfirm && (
          <button
            type="button"
            onClick={() => handleConfirmDelivery(order._id)}
            disabled={actionId === order._id}
            className="w-full text-xs font-semibold text-white bg-emerald-600 hover:bg-emerald-700 disabled:opacity-60 disabled:cursor-not-allowed py-2 rounded-md transition-colors"
          >
            {actionId === order._id
              ? t('OT_Validating')
              : t('OT_Confirm_Delivery')}
          </button>
        )}
        {order?.deliveryPlan?.confirmedByCustomer && (
          <p className="text-[11px] text-emerald-600">
            {t('OT_Confirmed_On')}
            {order?.deliveryPlan?.confirmedAt
              ? showDateFormat(order.deliveryPlan.confirmedAt)
              : ""}
          </p>
        )}
      </div>
    );
  };

  const columnsToRender =
    statuses && statuses.length > 0 ? statuses : Object.keys(STATUS_LABELS);

  return (
    <>
      {isLoading ? (
        <Loading loading={isLoading} />
      ) : (
        <Dashboard
          title={t('OT_Page_Title')}
          description={t('OT_Page_Desc')}
        >
          <div className="flex justify-between items-center mb-5">
            <div className="text-sm text-gray-500">
              {t('OT_Last_Update')} {lastUpdatedLabel}
            </div>
            <button
              type="button"
              onClick={loadBoard}
              disabled={loadingBoard}
              className="inline-flex items-center gap-2 px-3 py-2 rounded-md text-sm font-semibold border border-gray-200 hover:bg-gray-50 disabled:opacity-60"
            >
              <FiRefreshCw />
              {t('OT_Refresh')}
            </button>
          </div>

          {loadingBoard ? (
            <Loading loading={loadingBoard} />
          ) : error ? (
            <div className="text-center text-red-500">{error}</div>
          ) : (
            <div className="grid gap-4 md:grid-cols-2 xl:grid-cols-3">
              {columnsToRender.map((statusKey) => {
                const orders = board?.[statusKey] || [];
                const label = t(STATUS_LABELS[statusKey]) || statusKey;
                return (
                  <div
                    key={statusKey}
                    className="bg-emerald-50 border border-emerald-100 rounded-lg flex flex-col max-h-[70vh]"
                  >
                    <div className="p-4 border-b border-emerald-100">
                      <h3 className="font-semibold text-emerald-800">
                        {label}
                      </h3>
                      <p className="text-xs text-emerald-600">
                        {orders.length} {t('OT_Order_Count')}
                      </p>
                    </div>
                    <div className="flex-1 overflow-y-auto p-4 space-y-3">
                      {orders.length === 0 ? (
                        <p className="text-sm text-gray-500">
                          {t('OT_No_Orders_Step')}
                        </p>
                      ) : (
                        orders.map((order) => renderCard(order))
                      )}
                    </div>
                  </div>
                );
              })}
            </div>
          )}
        </Dashboard>
      )}
    </>
  );
};

export default CustomerOrderTracking;
