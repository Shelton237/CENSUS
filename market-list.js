import useTranslation from "next-translate/useTranslation";
import { useEffect, useMemo, useState } from "react";
import { FiPlus, FiSearch, FiTrash2, FiEdit3, FiChevronDown, FiChevronUp, FiCalendar, FiShoppingBag, FiInfo, FiCheckCircle } from "react-icons/fi";
import Dashboard from "@pages/user/dashboard";
import ProductServices from "@services/ProductServices";
import MarketListServices from "@services/MarketListServices";
import { notifyError, notifySuccess } from "@utils/toast";
import useGetSetting from "@hooks/useGetSetting";
import useUtilsFunction from "@hooks/useUtilsFunction";
import Loading from "@components/preloader/Loading";

const MarketListPage = () => {
  const { t } = useTranslation('common');
  const { storeCustomizationSetting } = useGetSetting();
  const { showingTranslateValue } = useUtilsFunction();

  const [isDrawerOpen, setIsDrawerOpen] = useState(false);
  const [editingList, setEditingList] = useState(null);
  const [expandedMarketListId, setExpandedMarketListId] = useState(null);
  const [productQuery, setProductQuery] = useState("");
  const [availableProducts, setAvailableProducts] = useState([]);
  const [loadingProducts, setLoadingProducts] = useState(false);
  const [productError, setProductError] = useState("");
  const [selectedProductId, setSelectedProductId] = useState("");
  const [quantity, setQuantity] = useState(1);
  const [desiredPrice, setDesiredPrice] = useState("");
  const [listItems, setListItems] = useState([]);
  const [listName, setListName] = useState("");
  const [listNote, setListNote] = useState("");
  const [lists, setLists] = useState([]);
  const [listsLoading, setListsLoading] = useState(false);
  const [listsError, setListsError] = useState("");
  const [submitting, setSubmitting] = useState(false);

  const openDrawer = () => setIsDrawerOpen(true);
  const closeDrawer = () => {
    setIsDrawerOpen(false);
    setEditingList(null);
    resetForm();
  };

  const resetForm = () => {
    setListItems([]);
    setListName("");
    setListNote("");
    setQuantity(1);
    setDesiredPrice("");
    setSelectedProductId("");
  };

  const totalListValue = useMemo(
    () =>
      listItems.reduce(
        (acc, item) => acc + (Number(item.desiredPrice) || 0) * item.quantity,
        0
      ),
    [listItems]
  );

  const fetchProducts = async () => {
    setLoadingProducts(true);
    try {
      const response = await ProductServices.getShowingStoreProducts({
        title: productQuery,
      });
      setAvailableProducts(response.products || []);
      setProductError("");
    } catch (err) {
      setProductError(err?.message || "Impossible de charger les produits.");
    } finally {
      setLoadingProducts(false);
    }
  };

  const fetchLists = async () => {
    setListsLoading(true);
    try {
      const response = await MarketListServices.find();
      setLists(Array.isArray(response) ? response : response.lists || []);
      setListsError("");
    } catch (err) {
      setListsError(err?.message || "Impossible de charger vos listes.");
    } finally {
      setListsLoading(false);
    }
  };

  useEffect(() => {
    fetchProducts();
    fetchLists();
  }, []);

  const currentProduct = useMemo(
    () => availableProducts.find((p) => p._id === selectedProductId),
    [selectedProductId, availableProducts]
  );

  const handleAddItem = () => {
    if (!selectedProductId) {
      notifyError("Sélectionnez un produit.");
      return;
    }
    const product = availableProducts.find((p) => p._id === selectedProductId);
    if (listItems.some((item) => item.productId === selectedProductId)) {
      notifyError("Ce produit est déjà dans votre liste.");
      return;
    }
    setListItems([
      ...listItems,
      {
        productId: selectedProductId,
        productTitle: showingTranslateValue(product.title),
        quantity: Number(quantity),
        desiredPrice: Number(desiredPrice) || 0,
      },
    ]);
    setSelectedProductId("");
    setQuantity(1);
    setDesiredPrice("");
  };

  const handleRemoveItem = (productId) => {
    setListItems(listItems.filter((item) => item.productId !== productId));
  };

  const handleSubmit = async () => {
    if (!listItems.length) {
      notifyError(t('Add_at_least_one_product'));
      return;
    }
    setSubmitting(true);
    try {
      const payload = {
        name: listName || "Ma liste de marché",
        note: listNote,
        items: listItems.map((item) => ({
          productId: item.productId,
          quantity: item.quantity,
          desiredPrice: item.desiredPrice,
        })),
      };

      if (editingList) {
        await MarketListServices.update(editingList._id, payload);
        notifySuccess("Liste mise à jour.");
      } else {
        await MarketListServices.create(payload);
        notifySuccess("Liste créée avec succès.");
      }
      closeDrawer();
      fetchLists();
    } catch (err) {
      notifyError(err?.message || t('Error_saving'));
    } finally {
      setSubmitting(false);
    }
  };

  const handleEditList = (list) => {
    setEditingList(list);
    setListName(list.name || "");
    setListNote(list.note || "");
    const items = list.items?.map((item) => ({
      productId: item.productId?._id || item.productId,
      productTitle: item.productId?.title ? showingTranslateValue(item.productId.title) : t('Product'),
      quantity: item.quantity,
      desiredPrice: item.desiredPrice,
    })) || [];
    setListItems(items);
    openDrawer();
  };

  const renderFormContent = () => (
    <div className="space-y-6">
      <div className="bg-emerald-50 border border-emerald-100 p-4 rounded-xl">
        <label className="block text-sm font-semibold text-emerald-900 mb-2">{t('List_name')}</label>
        <input
          className="w-full bg-white border border-emerald-200 rounded-lg px-4 py-2 text-sm focus:ring-2 focus:ring-emerald-500 focus:outline-none"
          placeholder="Ex: Marché de Samedi"
          value={listName}
          onChange={(e) => setListName(e.target.value)}
        />
      </div>

      <div className="space-y-4">
        <h4 className="font-bold text-gray-800 flex items-center gap-2">
          <FiPlus className="text-emerald-500" />
          Ajouter des produits
        </h4>
        <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
          <div className="space-y-2">
            <label className="text-xs font-semibold text-gray-500 uppercase px-1">{t('Product')}</label>
            <div className="flex gap-2">
               <div className="relative flex-1">
                 <input
                  className="w-full border border-gray-200 rounded-lg pl-9 pr-3 py-2 text-sm focus:ring-2 focus:ring-emerald-500"
                  placeholder={t('Search_dots')}
                  value={productQuery}
                  onChange={(e) => setProductQuery(e.target.value)}
                  onKeyPress={(e) => e.key === 'Enter' && fetchProducts()}
                />
                <FiSearch className="absolute left-3 top-2.5 text-gray-400" />
               </div>
               <button 
                  onClick={fetchProducts}
                  className="bg-emerald-500 text-white p-2 rounded-lg hover:bg-emerald-600 transition-colors"
                >
                  <FiSearch />
                </button>
            </div>
          </div>
          <div className="space-y-2">
             <label className="text-xs font-semibold text-gray-500 uppercase px-1">Sélection</label>
             <select
                className="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-emerald-500 bg-white"
                value={selectedProductId}
                onChange={(e) => setSelectedProductId(e.target.value)}
              >
                <option value="">{t('Choose')}</option>
                {availableProducts.map((p) => (
                  <option key={p._id} value={p._id}>{showingTranslateValue(p.title)}</option>
                ))}
              </select>
          </div>
        </div>

        <div className="grid grid-cols-2 gap-4">
          <div>
            <label className="text-xs font-semibold text-gray-500 uppercase px-1">Quantité</label>
            <input
              type="number"
              min="1"
              className="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-emerald-500 mt-1"
              value={quantity}
              onChange={(e) => setQuantity(e.target.value)}
            />
          </div>
          <div>
            <label className="text-xs font-semibold text-gray-500 uppercase px-1">{t('Unit_budget_fcfa')}</label>
            <input
              type="number"
              className="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-emerald-500 mt-1"
              value={desiredPrice}
              onChange={(e) => setDesiredPrice(e.target.value)}
            />
          </div>
        </div>
        
        <button
          onClick={handleAddItem}
          className="w-full bg-emerald-100 text-emerald-700 py-2.5 rounded-xl font-semibold hover:bg-emerald-200 transition-all flex items-center justify-center gap-2 border border-emerald-200"
        >
          <FiPlus /> Ajouter à la liste
        </button>
      </div>

      {listItems.length > 0 && (
        <div className="space-y-3">
          <h4 className="font-bold text-gray-800 flex items-center justify-between">
            Articles ajoutés
            <span className="text-xs bg-gray-100 px-2 py-1 rounded text-gray-500 font-normal">
              {listItems.length} article(s)
            </span>
          </h4>
          <div className="bg-gray-50 rounded-2xl p-2 border border-gray-100 space-y-1">
            {listItems.map((item) => (
              <div key={item.productId} className="bg-white p-3 rounded-xl shadow-sm border border-gray-50 flex items-center justify-between gap-4">
                <div className="flex-1 min-w-0">
                  <p className="text-sm font-semibold text-gray-900 truncate">{item.productTitle}</p>
                  <p className="text-xs text-gray-500">Qte: {item.quantity} | {item.desiredPrice} FCFA/u</p>
                </div>
                <div className="text-right flex items-center gap-3">
                   <p className="text-sm font-bold text-emerald-600">{(item.desiredPrice * item.quantity).toLocaleString('fr-FR')} F</p>
                   <button onClick={() => handleRemoveItem(item.productId)} className="text-red-400 hover:text-red-600 transition-colors">
                     <FiTrash2 />
                   </button>
                </div>
              </div>
            ))}
          </div>
          <div className="pt-2 flex justify-between items-center px-2">
             <span className="text-gray-500 text-sm font-medium">{t('Total_estimation')}</span>
             <span className="text-xl font-black text-emerald-600">{totalListValue.toLocaleString('fr-FR')} FCFA</span>
          </div>
        </div>
      )}

      <div className="pt-4 border-t border-gray-100">
        <label className="block text-sm font-semibold text-gray-700 mb-2">{t('Notes_or_instructions')}</label>
        <textarea
          className="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-emerald-500 h-24"
          placeholder="Ex: Acheter uniquement bio, bien mûr..."
          value={listNote}
          onChange={(e) => setListNote(e.target.value)}
        />
      </div>

      <button
        disabled={submitting}
        onClick={handleSubmit}
        className="w-full bg-emerald-500 text-white py-4 rounded-2xl font-bold  hover:bg-emerald-600 transition-all disabled:opacity-50 flex items-center justify-center gap-2 text-lg"
      >
        {submitting ? t('Processing') : editingList ? "Mettre à jour" : t('Submit_list')}
      </button>
    </div>
  );

  return (
    <Dashboard title="Market List">
      <div className="max-w-4xl mx-auto space-y-8 pb-10">
        <div className="flex flex-col md:flex-row md:items-center justify-between gap-4">
          <div>
            <h2 className="text-3xl font-black text-gray-900 tracking-tight">Liste de marché</h2>
            <p className="text-gray-500 text-sm mt-1">Gérez vos listes de courses et demandez une validation.</p>
          </div>
          <button
            onClick={() => { resetForm(); setEditingList(null); openDrawer(); }}
            className="inline-flex items-center justify-center gap-2 bg-emerald-500 hover:bg-emerald-600 text-white px-6 py-3 rounded-2xl font-bold  transition-all transform hover:-translate-y-0.5 active:translate-y-0"
          >
            <FiPlus className="text-xl" />
            Nouvelle liste
          </button>
        </div>

        <section className="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
          <div className="px-8 py-6 border-b border-gray-50 flex items-center justify-between flex-wrap gap-4">
            <h3 className="font-bold text-gray-800 flex items-center gap-2">
              <FiCalendar className="text-emerald-500" />
              Historique des listes
            </h3>
            <span className="px-3 py-1 bg-gray-100 rounded-full text-xs font-bold text-gray-500 uppercase tracking-wider">
              {lists.length} Liste(s)
            </span>
          </div>

          <div className="p-0">
             {listsLoading ? (
               <div className="p-20 flex flex-col items-center justify-center text-gray-400 gap-4">
                  <div className="w-10 h-10 border-4 border-emerald-500 border-t-transparent rounded-full animate-spin"></div>
                  <p className="animate-pulse font-medium">{t('Loading_history')}</p>
               </div>
             ) : listsError ? (
                <div className="p-10 text-center">
                  <p className="text-red-500 bg-red-50 p-4 rounded-xl inline-block">{listsError}</p>
                </div>
             ) : lists.length === 0 ? (
               <div className="p-20 flex flex-col items-center justify-center text-center space-y-4">
                  <div className="bg-emerald-50 p-6 rounded-full">
                    <FiShoppingBag className="text-6xl text-emerald-200" />
                  </div>
                  <div className="max-w-xs">
                    <h4 className="font-bold text-gray-800 text-lg">Aucune liste trouvée</h4>
                    <p className="text-gray-400 text-sm">Commencez par créer votre première liste de marché pour un suivi simplifié.</p>
                  </div>
                  <button 
                    onClick={openDrawer}
                    className="text-emerald-600 font-bold text-sm hover:underline flex items-center gap-1"
                  >
                   Créer une liste maintenant <FiPlus />
                  </button>
               </div>
             ) : (
               <div className="divide-y divide-gray-50">
                 {lists.map((list) => (
                   <div key={list._id} className="group hover:bg-emerald-50/30 transition-colors">
                     <div className="px-8 py-5">
                        <div className="flex items-start justify-between gap-4">
                           <div className="flex-1 space-y-1">
                              <div className="flex items-center gap-3">
                                <h4 className="font-bold text-gray-800 group-hover:text-emerald-700 transition-colors">{list.name}</h4>
                                <span className={`px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-widest
                                  ${list.status === 'pending' ? 'bg-orange-100 text-orange-600' : 'bg-emerald-100 text-emerald-600'}`}>
                                  {list.status === 'pending' ? t('Pending') : list.status}
                                </span>
                              </div>
                              <p className="text-xs text-gray-500 flex items-center gap-3">
                                <span className="flex items-center gap-1"><FiCalendar /> {new Date(list.createdAt).toLocaleDateString('fr-FR', { day:'numeric', month:'long', year:'numeric' })}</span>
                                <span className="flex items-center gap-1"><FiShoppingBag /> {list.items?.length || 0} articles</span>
                              </p>
                           </div>
                           <div className="text-right">
                              <p className="text-sm font-black text-gray-900">{(list.totalValue || 0).toLocaleString('fr-FR')} FCFA</p>
                              <div className="mt-2 flex items-center justify-end gap-2 opactiy-0 group-hover:opacity-100 transition-opacity">
                                 <button 
                                   onClick={() => handleToggleListDetails(list._id)}
                                   className="p-2 hover:bg-white rounded-lg border border-transparent hover:border-gray-100 shadow-sm transition-all"
                                   title="Détails"
                                 >
                                   {expandedMarketListId === list._id ? <FiChevronUp className="text-emerald-600" /> : <FiInfo className="text-emerald-600" />}
                                 </button>
                                 {list.status === 'pending' && (
                                   <button 
                                     onClick={() => handleEditList(list)}
                                     className="p-2 hover:bg-white rounded-lg border border-transparent hover:border-gray-100 shadow-sm transition-all"
                                     title={t('Edit')}
                                   >
                                     <FiEdit3 className="text-blue-500" />
                                   </button>
                                 )}
                              </div>
                           </div>
                        </div>

                        {expandedMarketListId === list._id && (
                          <div className="mt-4 bg-emerald-50/50 rounded-2xl p-5 border border-emerald-100 animate-in fade-in slide-in-from-top-2 duration-300">
                             <div className="space-y-4">
                               <div className="flex items-center justify-between px-1">
                                  <span className="text-xs font-bold text-emerald-800 uppercase tracking-wider">Détails des articles</span>
                                  {list.note && <span className="text-[10px] text-gray-400 italic font-medium max-w-[200px] truncate" title={list.note}> {t('Note')} {list.note}</span>}
                               </div>
                               <div className="grid gap-2">
                                 {list.items?.map((item, idx) => (
                                   <div key={idx} className="bg-white flex items-center justify-between p-3 rounded-xl border border-emerald-100/50 shadow-sm">
                                      <div className="flex items-center gap-3">
                                        <div className="w-8 h-8 rounded-full bg-emerald-100 flex items-center justify-center text-[10px] font-bold text-emerald-600">
                                          {item.quantity}
                                        </div>
                                        <span className="text-sm font-semibold text-gray-700">{item.productTitle || t('Product')}</span>
                                      </div>
                                      <div className="text-right">
                                        <span className="text-xs font-bold text-gray-900">{item.desiredPrice?.toLocaleString('fr-FR')} <span className="text-[10px] font-normal text-gray-400">F/u</span></span>
                                      </div>
                                   </div>
                                 ))}
                               </div>
                               <div className="pt-2 flex justify-end">
                                  <div className="bg-emerald-600 text-white px-4 py-2 rounded-xl text-sm font-bold shadow-lg shadow-emerald-100">
                                    Total: {(list.totalValue || 0).toLocaleString('fr-FR')} FCFA
                                  </div>
                               </div>
                             </div>
                          </div>
                        )}
                     </div>
                   </div>
                 ))}
               </div>
             )}
          </div>
        </section>
      </div>

      {isDrawerOpen && (
        <div className="fixed inset-0 z-[60] flex justify-end">
          <div className="absolute inset-0 bg-gray-900/40 backdrop-blur-sm transition-opacity" onClick={closeDrawer} />
          <div className="relative w-full max-w-lg h-full bg-white shadow-2xl flex flex-col animate-in slide-in-from-right duration-300">
            <div className="px-6 py-6 border-b border-gray-100 flex items-center justify-between">
              <div>
                <h3 className="text-2xl font-black text-gray-900">
                  {editingList ? t('Edit_list') : t('New_list')}
                </h3>
                <p className="text-xs text-gray-400 font-medium">Remplissez les détails ci-dessous</p>
              </div>
              <button 
                onClick={closeDrawer} 
                className="w-10 h-10 flex items-center justify-center rounded-full hover:bg-gray-100 transition-colors text-gray-500"
              >
                ✕
              </button>
            </div>
            <div className="flex-1 overflow-y-auto px-6 py-6">
              {renderFormContent()}
            </div>
          </div>
        </div>
      )}

      <style jsx>{`
        @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
        .animate-spin { animation: spin 1s linear infinite; }
        @keyframes spin { from { transform: rotate(0deg); } to { transform: rotate(360deg); } }
      `}</style>
    </Dashboard>
  );
};

export default MarketListPage;
