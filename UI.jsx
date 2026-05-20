import React, { useState, useEffect, useRef } from 'react';
import { 
  Menu, X, ChevronRight, MessageCircle, Instagram, Facebook, 
  MapPin, Phone, Mail, ArrowRight, Loader2, Edit, Trash2, Plus,
  Camera, Image as ImageIcon, PlayCircle, Quote, Star, History, Users,
  ShoppingBag, Heart, LogIn, LayoutDashboard, Save
} from 'lucide-react';

// --- FIREBASE INITIALIZATION ---
import { initializeApp } from 'firebase/app';
import { 
  getAuth, signInWithCustomToken, signInAnonymously, onAuthStateChanged 
} from 'firebase/auth';
import { 
  getFirestore, collection, doc, setDoc, getDoc, getDocs, 
  onSnapshot, addDoc, updateDoc, deleteDoc, query
} from 'firebase/firestore';

const firebaseConfig = typeof __firebase_config !== 'undefined' ? JSON.parse(__firebase_config) : {
  apiKey: "placeholder-key",
  authDomain: "placeholder-auth",
  projectId: "placeholder-project"
};

const app = initializeApp(firebaseConfig);
const auth = getAuth(app);
const db = getFirestore(app);
const appId = typeof __app_id !== 'undefined' ? __app_id : 'desa-dure-branding-app';

// --- ANIMATION COMPONENT ---
const FadeIn = ({ children, delay = 0, className = "" }) => {
  const [isVisible, setIsVisible] = useState(false);
  const ref = useRef(null);

  useEffect(() => {
    const observer = new IntersectionObserver(
      ([entry]) => {
        if (entry.isIntersecting) {
          setIsVisible(true);
          observer.unobserve(entry.target);
        }
      },
      { threshold: 0.1 }
    );
    if (ref.current) observer.observe(ref.current);
    return () => observer.disconnect();
  }, []);

  return (
    <div
      ref={ref}
      className={`transition-all duration-1000 ease-out ${
        isVisible ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-10'
      } ${className}`}
      style={{ transitionDelay: `${delay}ms` }}
    >
      {children}
    </div>
  );
};

// --- MAIN APP ---
export default function App() {
  const [user, setUser] = useState(null);
  const [currentView, setCurrentView] = useState('home');
  const [products, setProducts] = useState([]);
  const [craftsmen, setCraftsmen] = useState([]);
  const [gallery, setGallery] = useState([]);
  const [loading, setLoading] = useState(true);

  // Auth & Data Subscription
  useEffect(() => {
    const initApp = async () => {
      try {
        if (typeof __initial_auth_token !== 'undefined' && __initial_auth_token) {
          await signInWithCustomToken(auth, __initial_auth_token);
        } else {
          await signInAnonymously(auth);
        }
      } catch (err) { console.error("Auth error:", err); }
    };
    initApp();

    const unsubAuth = onAuthStateChanged(auth, (u) => {
      setUser(u);
    });

    return () => unsubAuth();
  }, []);

  useEffect(() => {
    if (!user) return;

    // Listen for Products
    const qProd = collection(db, 'artifacts', appId, 'public', 'data', 'products');
    const unsubProd = onSnapshot(qProd, (snap) => {
      const data = snap.docs.map(d => ({ id: d.id, ...d.data() }));
      setProducts(data.length > 0 ? data : MOCK_PRODUCTS);
      setLoading(false);
    }, (err) => {
        console.error(err);
        setProducts(MOCK_PRODUCTS);
        setLoading(false);
    });

    // Listen for Craftsmen
    const qCraft = collection(db, 'artifacts', appId, 'public', 'data', 'craftsmen');
    const unsubCraft = onSnapshot(qCraft, (snap) => {
      const data = snap.docs.map(d => ({ id: d.id, ...d.data() }));
      setCraftsmen(data.length > 0 ? data : MOCK_CRAFTSMEN);
    });

    // Listen for Gallery
    const qGal = collection(db, 'artifacts', appId, 'public', 'data', 'gallery');
    const unsubGal = onSnapshot(qGal, (snap) => {
      const data = snap.docs.map(d => ({ id: d.id, ...d.data() }));
      setGallery(data.length > 0 ? data : MOCK_GALLERY);
    });

    return () => { unsubProd(); unsubCraft(); unsubGal(); };
  }, [user]);

  if (loading) {
    return (
      <div className="min-h-screen bg-stone-50 flex items-center justify-center">
        <Loader2 className="w-8 h-8 animate-spin text-stone-800" />
      </div>
    );
  }

  return (
    <div className="min-h-screen bg-stone-50 text-stone-900 font-sans selection:bg-stone-800 selection:text-white">
      <Navbar currentView={currentView} setView={setCurrentView} />
      
      <main className="overflow-x-hidden">
        {currentView === 'home' && (
          <HomeView 
            products={products} 
            craftsmen={craftsmen} 
            gallery={gallery} 
            setView={setCurrentView} 
          />
        )}
        {currentView === 'catalog' && <CatalogView products={products} />}
        {currentView === 'history' && <HistoryView />}
        {currentView === 'admin' && <AdminDashboard products={products} craftsmen={craftsmen} gallery={gallery} />}
      </main>

      <Footer setView={setCurrentView} />
    </div>
  );
}

// --- SUB-COMPONENTS ---

const Navbar = ({ currentView, setView }) => {
  const [scrolled, setScrolled] = useState(false);
  const [mobileMenu, setMobileMenu] = useState(false);

  useEffect(() => {
    const handleScroll = () => setScrolled(window.scrollY > 50);
    window.addEventListener('scroll', handleScroll);
    return () => window.removeEventListener('scroll', handleScroll);
  }, []);

  const navLinks = [
    { id: 'home', label: 'Beranda' },
    { id: 'catalog', label: 'Katalog Produk' },
    { id: 'history', label: 'Sejarah & Budaya' },
    { id: 'admin', label: 'Dashboard', icon: <LayoutDashboard size={14} className="mr-1" /> }
  ];

  return (
    <nav className={`fixed w-full z-50 transition-all duration-500 ${
      scrolled || currentView !== 'home' ? 'bg-stone-50/95 backdrop-blur-md shadow-sm py-4' : 'bg-transparent py-6'
    }`}>
      <div className="max-w-7xl mx-auto px-6 flex justify-between items-center">
        <div 
          className={`font-serif text-2xl font-bold tracking-tighter cursor-pointer flex items-center ${
            scrolled || currentView !== 'home' ? 'text-stone-900' : 'text-white'
          }`}
          onClick={() => { setView('home'); window.scrollTo(0,0); }}
        >
          <span className="text-amber-600 mr-2">Dure</span>
          <span className="font-light">Artisan</span>
        </div>

        <div className={`hidden md:flex space-x-10 text-xs uppercase tracking-[0.2em] font-semibold ${
          scrolled || currentView !== 'home' ? 'text-stone-600' : 'text-stone-200'
        }`}>
          {navLinks.map(link => (
            <button 
              key={link.id} 
              onClick={() => { setView(link.id); window.scrollTo(0,0); }}
              className={`hover:text-amber-600 transition-colors flex items-center ${currentView === link.id ? 'text-amber-600' : ''}`}
            >
              {link.icon}{link.label}
            </button>
          ))}
        </div>

        <button 
          className={`md:hidden ${scrolled || currentView !== 'home' ? 'text-stone-900' : 'text-white'}`}
          onClick={() => setMobileMenu(!mobileMenu)}
        >
          {mobileMenu ? <X /> : <Menu />}
        </button>
      </div>

      {/* Mobile Nav */}
      {mobileMenu && (
        <div className="absolute top-full left-0 w-full bg-stone-50 border-t border-stone-200 p-6 flex flex-col space-y-6 md:hidden shadow-xl animate-in slide-in-from-top duration-300">
          {navLinks.map(link => (
            <button 
              key={link.id} 
              onClick={() => { setView(link.id); setMobileMenu(false); window.scrollTo(0,0); }}
              className="text-left font-serif text-xl border-b border-stone-100 pb-2"
            >
              {link.label}
            </button>
          ))}
        </div>
      )}
    </nav>
  );
};

const HomeView = ({ products, craftsmen, gallery, setView }) => (
  <>
    {/* Hero Section */}
    <section className="relative h-screen flex items-center justify-center">
      <div className="absolute inset-0 z-0">
        <img 
          src="https://images.unsplash.com/photo-1544963151-5072045cc95b?q=80&w=2000&auto=format&fit=crop" 
          alt="Dure Craftsmanship" 
          className="w-full h-full object-cover"
        />
        <div className="absolute inset-0 bg-stone-900/40 mix-blend-multiply"></div>
        <div className="absolute inset-0 bg-gradient-to-t from-stone-900/80 via-stone-900/20 to-transparent"></div>
      </div>
      
      <div className="relative z-10 text-center px-6 max-w-4xl mx-auto text-white">
        <FadeIn>
          <span className="inline-block px-4 py-1 border border-white/30 rounded-full text-xs uppercase tracking-[0.4em] mb-8 backdrop-blur-sm">
            Warisan Nusantara
          </span>
        </FadeIn>
        <FadeIn delay={200}>
          <h1 className="font-serif text-5xl md:text-8xl font-light mb-8 leading-[1.1]">
            Estetika Tradisi <br />
            <span className="italic font-normal">Dure Pengrajin</span>
          </h1>
        </FadeIn>
        <FadeIn delay={400}>
          <p className="text-stone-300 text-lg md:text-xl font-light max-w-2xl mx-auto mb-12 leading-relaxed">
            Membawa kehangatan alam ke dalam ruang Anda melalui setiap anyaman dan ukiran tangan asli Desa Dure.
          </p>
        </FadeIn>
        <FadeIn delay={600}>
          <div className="flex flex-col sm:flex-row gap-4 justify-center">
            <button 
              onClick={() => setView('catalog')}
              className="bg-white text-stone-900 px-10 py-4 uppercase tracking-widest text-xs font-bold hover:bg-stone-200 transition-all flex items-center justify-center gap-2"
            >
              Jelajahi Produk <ShoppingBag size={14} />
            </button>
            <button 
              onClick={() => setView('history')}
              className="border border-white/50 text-white px-10 py-4 uppercase tracking-widest text-xs font-bold hover:bg-white/10 transition-all"
            >
              Pelajari Budaya
            </button>
          </div>
        </FadeIn>
      </div>
    </section>

    {/* Village Intro */}
    <section className="py-32 px-6 bg-white">
      <div className="max-w-7xl mx-auto">
        <div className="grid grid-cols-1 lg:grid-cols-2 gap-24 items-center">
          <FadeIn>
            <div className="relative">
              <img 
                src="https://images.unsplash.com/photo-1510127034890-ba27508e9f1c?q=80&w=1200&auto=format&fit=crop" 
                className="w-full aspect-[4/5] object-cover rounded-sm shadow-2xl" 
                alt="Village Atmosphere"
              />
              <div className="absolute -bottom-10 -right-10 hidden md:block w-64 h-64 border-[20px] border-stone-50 -z-10"></div>
            </div>
          </FadeIn>
          <div>
            <FadeIn delay={200}>
              <span className="text-amber-700 font-bold uppercase tracking-widest text-xs block mb-6">Tentang Kami</span>
              <h2 className="font-serif text-4xl md:text-5xl text-stone-900 mb-10 leading-tight">
                Identitas yang Dianyam <br />
                <span className="italic text-stone-400">dengan Hati & Jiwa.</span>
              </h2>
              <div className="space-y-8 text-stone-600 leading-relaxed text-lg font-light">
                <p>
                  Desa Dure telah lama dikenal sebagai jantung kreativitas lokal. Setiap rumah di desa kami bukan sekadar tempat tinggal, melainkan bengkel seni tempat keterampilan diturunkan dari satu generasi ke generasi berikutnya.
                </p>
                <p>
                  Melalui inisiatif UMKM Desa Dure, kami bertekad menjaga relevansi budaya ini di dunia modern. Produk kami bukan sekadar barang fungsional; mereka adalah simbol ketahanan budaya dan dedikasi pengrajin kami terhadap kualitas.
                </p>
              </div>
              <div className="mt-12 flex gap-12 border-t border-stone-100 pt-10">
                <div>
                  <div className="text-3xl font-serif text-stone-900 mb-1">150+</div>
                  <div className="text-xs uppercase tracking-widest text-stone-500 font-bold">Keluarga Pengrajin</div>
                </div>
                <div>
                  <div className="text-3xl font-serif text-stone-900 mb-1">200+</div>
                  <div className="text-xs uppercase tracking-widest text-stone-500 font-bold">Jenis Produk</div>
                </div>
              </div>
            </FadeIn>
          </div>
        </div>
      </div>
    </section>

    {/* Featured Products */}
    <section className="py-32 px-6 bg-stone-50">
      <div className="max-w-7xl mx-auto">
        <div className="flex flex-col md:flex-row justify-between items-end mb-20 gap-8">
          <div>
            <span className="text-amber-700 font-bold uppercase tracking-widest text-xs block mb-4 text-center md:text-left">Koleksi Pilihan</span>
            <h2 className="font-serif text-4xl md:text-5xl text-stone-900 text-center md:text-left">Mahakarya Unggulan</h2>
          </div>
          <button 
            onClick={() => setView('catalog')}
            className="group flex items-center gap-3 text-sm uppercase tracking-[0.2em] font-bold text-stone-800 hover:text-amber-700 transition-all border-b border-stone-300 pb-2"
          >
            Lihat Katalog Lengkap <ArrowRight size={16} className="group-hover:translate-x-2 transition-transform" />
          </button>
        </div>
        
        <div className="grid grid-cols-1 md:grid-cols-3 gap-12">
          {products.slice(0, 3).map((p, i) => (
            <FadeIn key={p.id} delay={i * 200}>
              <ProductCard product={p} />
            </FadeIn>
          ))}
        </div>
      </div>
    </section>

    {/* Craftsmen Section */}
    <section className="py-32 px-6 bg-stone-900 text-white overflow-hidden">
      <div className="max-w-7xl mx-auto">
        <div className="text-center mb-24">
          <FadeIn>
            <span className="text-amber-500 font-bold uppercase tracking-widest text-xs block mb-4">Sang Maestro</span>
            <h2 className="font-serif text-4xl md:text-5xl mb-6">Jiwa di Balik Karya</h2>
            <p className="text-stone-400 max-w-2xl mx-auto font-light">Bertemu dengan para pahlawan budaya kami yang mendedikasikan hidupnya untuk kesempurnaan setiap detail.</p>
          </FadeIn>
        </div>

        <div className="grid grid-cols-1 md:grid-cols-2 gap-16">
          {craftsmen.slice(0, 2).map((c, i) => (
            <FadeIn key={c.id} delay={i * 200}>
              <div className="flex flex-col md:flex-row gap-8 items-center bg-stone-800/50 p-8 border border-white/5 hover:border-amber-500/30 transition-all group">
                <img src={c.image} alt={c.name} className="w-48 h-48 rounded-full object-cover grayscale group-hover:grayscale-0 transition-all duration-700 ring-4 ring-stone-700" />
                <div>
                  <h4 className="font-serif text-2xl mb-2 text-amber-500">{c.name}</h4>
                  <p className="text-stone-500 text-xs uppercase tracking-widest font-bold mb-4">{c.role}</p>
                  <p className="text-stone-300 font-light leading-relaxed italic">"{c.quote}"</p>
                </div>
              </div>
            </FadeIn>
          ))}
        </div>
      </div>
    </section>

    {/* Gallery Section */}
    <section className="py-32 px-6 bg-white">
      <div className="max-w-7xl mx-auto text-center mb-20">
        <span className="text-amber-700 font-bold uppercase tracking-widest text-xs block mb-4">Momen Dure</span>
        <h2 className="font-serif text-4xl md:text-5xl text-stone-900 mb-6">Galeri Kreativitas</h2>
      </div>
      <div className="columns-1 sm:columns-2 lg:columns-3 gap-6 space-y-6">
        {gallery.map((item, i) => (
          <FadeIn key={item.id} delay={i * 100} className="break-inside-avoid">
            <div className="relative group overflow-hidden bg-stone-100">
              <img 
                src={item.url} 
                alt={item.title} 
                className="w-full h-auto object-cover transition-transform duration-1000 group-hover:scale-105"
              />
              <div className="absolute inset-0 bg-stone-900/60 opacity-0 group-hover:opacity-100 transition-all duration-500 flex items-center justify-center p-6">
                <div className="text-center transform translate-y-4 group-hover:translate-y-0 transition-transform">
                  <h5 className="text-white font-serif text-xl mb-2">{item.title}</h5>
                  <p className="text-stone-300 text-xs uppercase tracking-widest">{item.category}</p>
                </div>
              </div>
            </div>
          </FadeIn>
        ))}
      </div>
    </section>
  </>
);

const CatalogView = ({ products }) => (
  <div className="pt-40 pb-32 px-6">
    <div className="max-w-7xl mx-auto">
      <div className="text-center mb-24">
        <span className="text-amber-700 font-bold uppercase tracking-widest text-xs block mb-4">Showcase</span>
        <h1 className="font-serif text-5xl md:text-7xl text-stone-900 mb-8">Katalog Produk UMKM</h1>
        <div className="w-24 h-1 bg-amber-600 mx-auto mb-8"></div>
        <p className="text-stone-600 max-w-2xl mx-auto font-light leading-relaxed">
          Temukan koleksi eksklusif hasil tangan terampil warga Desa Dure. Setiap pembelian mendukung keberlangsungan ekonomi pengrajin lokal kami.
        </p>
      </div>

      <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-x-12 gap-y-20">
        {products.map((p, i) => (
          <FadeIn key={p.id} delay={i * 100}>
            <ProductCard product={p} />
          </FadeIn>
        ))}
      </div>
    </div>
  </div>
);

const HistoryView = () => (
  <div className="pt-40 pb-32 px-6 bg-stone-100">
    <div className="max-w-4xl mx-auto">
      <div className="bg-white p-12 md:p-20 shadow-2xl">
        <span className="text-amber-700 font-bold uppercase tracking-widest text-xs block mb-8">Warisan Leluhur</span>
        <h1 className="font-serif text-5xl md:text-6xl text-stone-900 mb-12 leading-tight">Riwayat Desa Dure</h1>
        
        <div className="prose prose-stone prose-lg max-w-none text-stone-600 space-y-10 leading-relaxed font-light">
          <p className="first-letter:text-7xl first-letter:font-serif first-letter:text-amber-700 first-letter:mr-3 first-letter:float-left">
            Dahulu kala, Desa Dure hanyalah pemukiman kecil di lereng perbukitan hijau. Masyarakatnya hidup berdampingan dengan hutan yang kaya akan bambu, rotan, dan kayu jati. Kesadaran untuk mengolah hasil alam ini dimulai saat sesepuh desa menemukan cara untuk menciptakan wadah penyimpanan yang kokoh namun indah untuk hasil panen mereka.
          </p>
          
          <img 
            src="https://images.unsplash.com/photo-1523726491678-bf852e717f6a?q=80&w=1200&auto=format&fit=crop" 
            alt="History" 
            className="w-full h-96 object-cover rounded-sm grayscale hover:grayscale-0 transition-all duration-1000 my-16" 
          />

          <h3 className="font-serif text-3xl text-stone-900 mt-16 mb-6">Evolusi Seni Anyaman</h3>
          <p>
            Memasuki era 1950-an, kerajinan Dure mulai dikenal di luar wilayah kabupaten. Teknik anyaman "Tiga Lapis" yang unik menjadi ciri khas yang sulit ditiru, memberikan kekuatan struktur sekaligus detail pola yang rumit. Produk tidak lagi hanya sekadar alat tani, melainkan mulai merambah ke dekorasi interior dan perlengkapan rumah tangga premium.
          </p>
          
          <div className="bg-stone-50 p-10 border-l-8 border-amber-700 italic text-stone-800 text-xl font-serif">
            "Kekuatan sebuah anyaman bukan terletak pada satu helai bambu, melainkan pada bagaimana ribuan helai tersebut saling mengikat dan mendukung satu sama lain." - Pepatah Desa Dure.
          </div>

          <h3 className="font-serif text-3xl text-stone-900 mt-16 mb-6">UMKM Masa Kini</h3>
          <p>
            Saat ini, Desa Dure bertransformasi menjadi desa mandiri ekonomi. Dengan bantuan teknologi dan branding yang tepat, kami berupaya membawa identitas lokal ini ke kancah nasional dan internasional. Kami tetap mempertahankan metode manual (handmade) karena di sanalah letak nilai "kemewahan" sesungguhnya dari produk Desa Dure.
          </p>
        </div>
      </div>
    </div>
  </div>
);

const ProductCard = ({ product }) => {
  const handleWA = () => {
    const msg = `Halo, saya tertarik dengan produk ${product.name} dari Desa Dure. Boleh minta informasi ketersediaan?`;
    window.open(`https://wa.me/${product.wa || '6281234567890'}?text=${encodeURIComponent(msg)}`, '_blank');
  };

  return (
    <div className="group flex flex-col h-full bg-white border border-stone-100 shadow-sm hover:shadow-xl transition-all duration-500">
      <div className="relative aspect-[4/5] overflow-hidden">
        <img 
          src={product.image} 
          alt={product.name} 
          className="w-full h-full object-cover transition-transform duration-1000 group-hover:scale-110" 
        />
        <div className="absolute top-4 right-4 bg-amber-700 text-white text-[10px] font-bold uppercase tracking-widest px-3 py-1">
          {product.category || 'Terpopuler'}
        </div>
        <div className="absolute inset-0 bg-stone-900/10 group-hover:bg-transparent transition-all"></div>
      </div>
      
      <div className="p-10 flex flex-col flex-grow">
        <div className="flex justify-between items-start mb-6">
          <h3 className="font-serif text-2xl text-stone-900 flex-grow pr-4">{product.name}</h3>
          <span className="font-bold text-amber-800 text-lg">{product.price}</span>
        </div>
        <p className="text-stone-500 text-sm font-light leading-relaxed mb-10 flex-grow line-clamp-3">
          {product.description}
        </p>
        <button 
          onClick={handleWA}
          className="w-full bg-stone-900 text-white py-4 flex items-center justify-center gap-3 uppercase tracking-widest text-[10px] font-bold hover:bg-amber-800 transition-colors"
        >
          Pesan via WhatsApp <MessageCircle size={14} />
        </button>
      </div>
    </div>
  );
};

const Footer = ({ setView }) => (
  <footer className="bg-stone-900 text-stone-400 pt-32 pb-20 px-6">
    <div className="max-w-7xl mx-auto">
      <div className="grid grid-cols-1 md:grid-cols-12 gap-16 mb-24">
        <div className="md:col-span-5">
          <div className="font-serif text-3xl text-white font-bold mb-8">Dure Artisan.</div>
          <p className="text-stone-500 font-light leading-relaxed mb-10 text-lg">
            Mendedikasikan diri untuk melestarikan tradisi melalui seni kerajinan tangan berkualitas tinggi. Dari Desa Dure, untuk estetika ruang Anda.
          </p>
          <div className="flex gap-6">
            <a href="#" className="hover:text-amber-500 transition-colors"><Instagram size={20} /></a>
            <a href="#" className="hover:text-amber-500 transition-colors"><Facebook size={20} /></a>
            <a href="#" className="hover:text-amber-500 transition-colors"><Mail size={20} /></a>
          </div>
        </div>
        
        <div className="md:col-span-2">
          <h5 className="text-white text-xs uppercase tracking-[0.2em] font-bold mb-8">Navigasi</h5>
          <ul className="space-y-4 text-sm font-light">
            <li><button onClick={() => setView('home')} className="hover:text-amber-500">Beranda</button></li>
            <li><button onClick={() => setView('catalog')} className="hover:text-amber-500">Katalog Produk</button></li>
            <li><button onClick={() => setView('history')} className="hover:text-amber-500">Sejarah & Budaya</button></li>
          </ul>
        </div>

        <div className="md:col-span-5">
          <h5 className="text-white text-xs uppercase tracking-[0.2em] font-bold mb-8">Hubungi Pengelola</h5>
          <div className="space-y-6 text-sm font-light">
            <div className="flex gap-4">
              <MapPin className="text-amber-700 shrink-0" size={18} />
              <span>Pusat Kerajinan Terpadu, Jl. Raya Dure No. 45, Kec. Seni, Kabupaten Kultur.</span>
            </div>
            <div className="flex gap-4">
              <Phone className="text-amber-700 shrink-0" size={18} />
              <span>+62 812-3456-7890 (Humas UMKM)</span>
            </div>
            <div className="flex gap-4">
              <Mail className="text-amber-700 shrink-0" size={18} />
              <span>info@desadure.id</span>
            </div>
          </div>
        </div>
      </div>
      
      <div className="border-t border-white/5 pt-12 flex flex-col md:flex-row justify-between items-center gap-6 text-[10px] uppercase tracking-widest font-bold text-stone-600">
        <p>© 2024 Desa Pengrajin Dure - Semua Hak Dilindungi</p>
        <div className="flex gap-10">
          <a href="#" className="hover:text-white">Kebijakan Privasi</a>
          <a href="#" className="hover:text-white">Syarat & Ketentuan</a>
        </div>
      </div>
    </div>
  </footer>
);

// --- ADMIN DASHBOARD ---
const AdminDashboard = ({ products, craftsmen, gallery }) => {
  const [activeTab, setActiveTab] = useState('products');
  const [editing, setEditing] = useState(null);
  const [loading, setLoading] = useState(false);

  const handleSave = async (e) => {
    e.preventDefault();
    setLoading(true);
    const formData = new FormData(e.target);
    const data = Object.fromEntries(formData.entries());
    
    try {
      const coll = activeTab === 'products' ? 'products' : activeTab === 'craftsmen' ? 'craftsmen' : 'gallery';
      const ref = collection(db, 'artifacts', appId, 'public', 'data', coll);
      
      if (editing && editing.id) {
        await updateDoc(doc(ref, editing.id), data);
      } else {
        await addDoc(ref, data);
      }
      setEditing(null);
    } catch (err) { console.error(err); }
    setLoading(false);
  };

  const handleDelete = async (id) => {
    if (!window.confirm("Hapus data ini?")) return;
    try {
      const coll = activeTab === 'products' ? 'products' : activeTab === 'craftsmen' ? 'craftsmen' : 'gallery';
      await deleteDoc(doc(db, 'artifacts', appId, 'public', 'data', coll, id));
    } catch (err) { console.error(err); }
  };

  return (
    <div className="pt-40 pb-32 px-6 min-h-screen bg-stone-100">
      <div className="max-w-6xl mx-auto bg-white p-12 shadow-2xl">
        <div className="flex flex-col md:flex-row justify-between items-start md:items-center mb-12 gap-6 border-b border-stone-100 pb-10">
          <div>
            <h1 className="font-serif text-4xl text-stone-900 mb-2">Panel Admin</h1>
            <p className="text-stone-500 text-sm">Kelola konten dan katalog Desa Dure</p>
          </div>
          <button 
            onClick={() => setEditing({})} 
            className="bg-stone-900 text-white px-6 py-3 text-xs font-bold uppercase tracking-widest flex items-center gap-2 hover:bg-amber-800 transition-all"
          >
            <Plus size={14} /> Tambah Data Baru
          </button>
        </div>

        <div className="flex gap-10 mb-10 overflow-x-auto pb-4">
          {['products', 'craftsmen', 'gallery'].map(tab => (
            <button 
              key={tab}
              onClick={() => setActiveTab(tab)}
              className={`text-xs uppercase tracking-widest font-bold pb-2 border-b-2 transition-all ${
                activeTab === tab ? 'border-amber-700 text-amber-700' : 'border-transparent text-stone-400 hover:text-stone-600'
              }`}
            >
              Manajemen {tab === 'products' ? 'Produk' : tab === 'craftsmen' ? 'Pengrajin' : 'Galeri'}
            </button>
          ))}
        </div>

        {editing ? (
          <div className="bg-stone-50 p-10 border border-stone-200 mb-10 animate-in fade-in duration-500">
            <h3 className="font-serif text-2xl mb-8">{editing.id ? 'Edit' : 'Tambah'} {activeTab}</h3>
            <form onSubmit={handleSave} className="grid grid-cols-1 md:grid-cols-2 gap-8">
              {activeTab === 'products' && (
                <>
                  <Input label="Nama Produk" name="name" defaultValue={editing.name} required />
                  <Input label="Harga" name="price" defaultValue={editing.price} required />
                  <Input label="Kategori" name="category" defaultValue={editing.category} />
                  <Input label="URL Gambar" name="image" defaultValue={editing.image} required />
                  <div className="md:col-span-2">
                    <label className="text-[10px] font-bold uppercase text-stone-500 block mb-2">Deskripsi</label>
                    <textarea name="description" defaultValue={editing.description} className="w-full bg-white border border-stone-300 p-4 outline-none focus:border-amber-700 min-h-[150px]" required></textarea>
                  </div>
                </>
              )}
              {activeTab === 'craftsmen' && (
                <>
                  <Input label="Nama Pengrajin" name="name" defaultValue={editing.name} required />
                  <Input label="Peran/Role" name="role" defaultValue={editing.role} required />
                  <Input label="URL Foto" name="image" defaultValue={editing.image} required />
                  <div className="md:col-span-2">
                    <label className="text-[10px] font-bold uppercase text-stone-500 block mb-2">Kutipan/Quote</label>
                    <textarea name="quote" defaultValue={editing.quote} className="w-full bg-white border border-stone-300 p-4 outline-none focus:border-amber-700 min-h-[100px]" required></textarea>
                  </div>
                </>
              )}
              {activeTab === 'gallery' && (
                <>
                  <Input label="Judul Foto" name="title" defaultValue={editing.title} required />
                  <Input label="Kategori" name="category" defaultValue={editing.category} required />
                  <Input label="URL Gambar" name="url" defaultValue={editing.url} required className="md:col-span-2" />
                </>
              )}
              <div className="md:col-span-2 flex gap-4 mt-4">
                <button type="submit" disabled={loading} className="bg-amber-700 text-white px-8 py-3 text-xs font-bold uppercase tracking-widest flex items-center gap-2 hover:bg-amber-800 disabled:opacity-50">
                  {loading ? <Loader2 className="animate-spin" size={14} /> : <Save size={14} />} Simpan Perubahan
                </button>
                <button type="button" onClick={() => setEditing(null)} className="bg-stone-200 text-stone-800 px-8 py-3 text-xs font-bold uppercase tracking-widest hover:bg-stone-300">
                  Batal
                </button>
              </div>
            </form>
          </div>
        ) : (
          <div className="grid grid-cols-1 gap-4">
            {(activeTab === 'products' ? products : activeTab === 'craftsmen' ? craftsmen : gallery).map(item => (
              <div key={item.id} className="flex items-center justify-between p-6 bg-stone-50 border border-stone-200 group hover:border-amber-500 transition-all">
                <div className="flex items-center gap-6">
                  <img src={item.image || item.url} className="w-16 h-16 object-cover rounded-sm border border-stone-300" />
                  <div>
                    <h5 className="font-serif text-lg text-stone-900">{item.name || item.title}</h5>
                    <p className="text-stone-500 text-[10px] uppercase tracking-widest">{item.category || item.role}</p>
                  </div>
                </div>
                <div className="flex gap-4">
                  <button onClick={() => setEditing(item)} className="p-3 text-stone-400 hover:text-amber-700 bg-white border border-stone-200"><Edit size={16} /></button>
                  <button onClick={() => handleDelete(item.id)} className="p-3 text-stone-400 hover:text-red-600 bg-white border border-stone-200"><Trash2 size={16} /></button>
                </div>
              </div>
            ))}
          </div>
        )}
      </div>
    </div>
  );
};

const Input = ({ label, className = "", ...props }) => (
  <div className={className}>
    <label className="text-[10px] font-bold uppercase text-stone-500 block mb-2">{label}</label>
    <input 
      className="w-full bg-white border border-stone-300 p-4 outline-none focus:border-amber-700 transition-colors" 
      {...props} 
    />
  </div>
);

// --- CONSTANTS & MOCKS ---
const MOCK_PRODUCTS = [
  { id: '1', name: 'Vas Dure Klasik', price: 'Rp 450.000', description: 'Vas bunga dengan teknik anyaman silang yang elegan. Menggunakan bahan bambu pilihan dengan finishing ramah lingkungan.', image: 'https://images.unsplash.com/photo-1610701596007-11502861dcfa?q=80&w=800&auto=format&fit=crop', category: 'Dekorasi' },
  { id: '2', name: 'Tikar Meditasi Dure', price: 'Rp 320.000', description: 'Tikar meditasi sejuk dan awet. Menghadirkan kenyamanan alami untuk rutinitas harian Anda.', image: 'https://images.unsplash.com/photo-1598300042247-d088f8ab3a91?q=80&w=800&auto=format&fit=crop', category: 'Lifestyle' },
  { id: '3', name: 'Lentera Malam Dure', price: 'Rp 850.000', description: 'Lampu hias dengan efek bayangan artistik. Memberikan nuansa etnik yang mewah pada kamar tidur atau ruang tamu.', image: 'https://images.unsplash.com/photo-1513519245088-0e12902e5a38?q=80&w=800&auto=format&fit=crop', category: 'Penerangan' }
];

const MOCK_CRAFTSMEN = [
  { id: 'c1', name: 'Bapak Karsa', role: 'Ahli Anyaman Bambu', image: 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?q=80&w=800&auto=format&fit=crop', quote: 'Kesabaran adalah pola yang paling indah dalam setiap kerajinan tangan.' },
  { id: 'c2', name: 'Ibu Murni', role: 'Kurator Tekstil Alami', image: 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?q=80&w=800&auto=format&fit=crop', quote: 'Warna yang berasal dari alam tidak akan pernah pudar oleh waktu.' }
];

const MOCK_GALLERY = [
  { id: 'g1', url: 'https://images.unsplash.com/photo-1606760227091-3dd870d97f1d?q=80&w=800&auto=format&fit=crop', title: 'Pemilihan Bahan Baku', category: 'Proses' },
  { id: 'g2', url: 'https://images.unsplash.com/photo-1452860606245-08befc0ff44b?q=80&w=800&auto=format&fit=crop', title: 'Detail Anyaman Halus', category: 'Produk' },
  { id: 'g3', url: 'https://images.unsplash.com/photo-1523726491678-bf852e717f6a?q=80&w=800&auto=format&fit=crop', title: 'Workshop Bersama', category: 'Komunitas' },
  { id: 'g4', url: 'https://images.unsplash.com/photo-1516962215378-7fa2e137ae93?q=80&w=800&auto=format&fit=crop', title: 'Pewarnaan Organik', category: 'Teknik' }
];